<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectAttachment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $projects = Project::query()
            ->with('user')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('customer', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('architect', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
            
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $users = User::where('role', 'customer')->get();
        return view('projects.create', compact('users'));
    }

  /**
 * Store a newly created project in storage.
 */
public function store(Request $request)
{
    $request->merge(['user_id' => auth()->id()]);

    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'project_type' => 'required|in:residential,contractor',
        'customer' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'attention' => 'nullable|string|max:255',
        'address' => 'nullable|string',
        'architect' => 'nullable|string|max:255',
        'bid_date' => 'nullable|date',
        'plan_date' => 'nullable|date',
        'date_accepted' => 'nullable|date',
        'attachments' => 'nullable|array',
        'attachments.*' => 'nullable|file|max:25600', // 25MB max file size
        'descriptions' => 'nullable|array',
        'descriptions.*' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Create the project
    $project = Project::create($request->all());

    // Set pricing factors based on project type
    $project->setPricingFactors();

    // Handle attachments if any were uploaded
    if ($request->hasFile('attachments')) {
        $attachments = $request->file('attachments');
        $descriptions = $request->input('descriptions', []);

        foreach ($attachments as $index => $attachment) {
            // Skip if the file input is empty
            if (!$attachment || !$attachment->isValid()) {
                continue;
            }

            // Generate a unique filename
            $filename = uniqid() . '_' . $attachment->getClientOriginalName();
            
            // Store the file in project-specific folder
            $path = $attachment->storeAs('project-attachments/' . $project->id, $filename, 'public');
            
            // Create the attachment record with description if provided
            $project->attachments()->create([
                'filename' => $filename,
                'path' => $path,
                'original_filename' => $attachment->getClientOriginalName(),
                'mime_type' => $attachment->getMimeType(),
                'size' => $attachment->getSize(),
                'description' => $descriptions[$index] ?? null,
            ]);
        }
    }

    return redirect()->route('projects.index')
        ->with('success', 'Project created successfully.');
}

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        //$project->load('user', 'placeTakeoff', 'measuringTemplate', 'materials', 'fabrication', 'installationLabor', 'settingMaterial');
        $project->load('user');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $users = User::where('role', 'customer')->get();
        return view('projects.edit', compact('project', 'users'));
    }

  /**
 * Update the specified project in storage.
 */
public function update(Request $request, Project $project)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'project_type' => 'required|in:residential,contractor',
        'customer' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'attention' => 'nullable|string|max:255',
        'address' => 'nullable|string',
        'architect' => 'nullable|string|max:255',
        'bid_date' => 'nullable|date',
        'plan_date' => 'nullable|date',
        'date_accepted' => 'nullable|date',
        'attachments' => 'nullable|array',
        'attachments.*' => 'nullable|file|max:25600', // 25MB max file size
        'descriptions' => 'nullable|array',
        'descriptions.*' => 'nullable|string|max:255',
        'delete_attachments' => 'nullable|array',
        'delete_attachments.*' => 'exists:project_attachments,id',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $oldType = $project->project_type;
        // Update the project
        $project->update($request->only([
            'name', 'project_type', 'customer', 'email', 'phone', 
            'attention', 'address', 'architect',
            'bid_date', 'plan_date', 'date_accepted'
        ]));
    
    //$project->update($request->all());
    
    // If project type changed, update pricing factors
    if ($oldType !== $project->project_type) {
        $project->setPricingFactors();
    }

    // Delete selected attachments if any
    if ($request->has('delete_attachments')) {
        $attachmentsToDelete = $project->attachments()->whereIn('id', $request->delete_attachments)->get();
        
        foreach ($attachmentsToDelete as $attachment) {
            // Delete the actual file
            Storage::disk('public')->delete($attachment->path);
            
            // Delete the record
            $attachment->delete();
        }
    }

    // Handle new attachments if any were uploaded
    if ($request->hasFile('attachments')) {
        $attachments = $request->file('attachments');
        $descriptions = $request->input('descriptions', []);

        foreach ($attachments as $index => $attachment) {
            // Skip if the file input is empty
            if (!$attachment || !$attachment->isValid()) {
                continue;
            }

            // Generate a unique filename
            $filename = uniqid() . '_' . $attachment->getClientOriginalName();
            
            // Store the file in project-specific folder
            $path = $attachment->storeAs('project-attachments/' . $project->id, $filename, 'public');
            
            // Create the attachment record with description if provided
            $project->attachments()->create([
                'filename' => $filename,
                'path' => $path,
                'original_filename' => $attachment->getClientOriginalName(),
                'mime_type' => $attachment->getMimeType(),
                'size' => $attachment->getSize(),
                'description' => $descriptions[$index] ?? null,
            ]);
        }
    }

    return redirect()->route('projects.show', $project)
        ->with('success', 'Project updated successfully.');
}




        /**
         * Get the summary content for the modal
         */
        public function summaryContent(Project $project)
        {
            $takeoffsByType = $project->placeTakeoffs->groupBy('type');
            $sinks = $project->sinks;
            
            // Calculate the totals (similar to what you're doing in the view)
            // [Add your calculation code here]
            
            return view('projects.summary-content', compact('project', 'takeoffsByType', 'sinks'));
        }

            /**
             * Generate a printable summary
             */
            public function printSummary(Project $project)
            {
                $takeoffsByType = $project->placeTakeoffs->groupBy('type');
                $sinks = $project->sinks;
                
                return view('projects.print-summary', compact('project', 'takeoffsByType', 'sinks'));
            }



            /**
                 * Generate a PDF of the project summary
                 *
                 * @param int $id
                 * @return \Illuminate\Http\Response
                 */
                public function generatePdf($id)
                {
                    // Retrieve the project with necessary relationships
                    $project = Project::with(['placeTakeoffs', 'sinks'])->findOrFail($id);
                    
                    // Group takeoffs by type
                    $takeoffsByType = $project->placeTakeoffs->groupBy('type');
                    
                    // For sinks, make sure we can access them by area
                    $sinks = $project->sinks;
                    
                    // Any other data preparation you need for the summary view...
                    
                    // Create PDF using dompdf
                    $pdf = \PDF::loadView('projects.summary-pdf', [
                        'project' => $project,
                        'takeoffsByType' => $takeoffsByType,
                        'sinks' => $sinks,
                        // Add any other variables needed for the summary view
                    ]);
                    
                    // Optional: Set paper size and orientation
                    $pdf->setPaper('a4', 'portrait');
                    
                    // Download the PDF (alternatively, you can use ->stream() to display in browser)
                    return $pdf->download($project->name . '_Summary_' . now()->format('Y-m-d') . '.pdf');
                }



                /**
             * Generate a unique share token for the project
             *
             * @param int $id
             * @return \Illuminate\Http\RedirectResponse
             */
            public function generateShareLink($id)
            {
                $project = Project::findOrFail($id);
                
                // Generate a UUID for the share token
                $project->share_token = (string) Str::uuid();
                
                // Set expiration date (30 days from now)
                $project->share_expires_at = now()->addDays(30);
                
                $project->save();
                
                return back()->with('success', 'Share link generated successfully!');
            }

            /**
             * Display the public summary view using a share token
             *
             * @param string $token
             * @return \Illuminate\Http\Response
             */
            public function publicSummary($token)
            {
                // Find the project by share token
                $project = Project::where('share_token', $token)
                                ->where(function ($query) {
                                    $query->whereNull('share_expires_at')
                                        ->orWhere('share_expires_at', '>', now());
                                })
                                ->firstOrFail();
                
                // Load necessary relationships
                $project->load(['placeTakeoffs', 'sinks']);
                
                // Group takeoffs by type
                $takeoffsByType = $project->placeTakeoffs->groupBy('type');
                
                // Return the public summary view
                return view('projects.public-summary', [
                    'project' => $project,
                    'takeoffsByType' => $takeoffsByType,
                    'sinks' => $project->sinks,
                    'isPublic' => true
                ]);
            }

            /**
             * Generate a PDF of the project summary from a public share link
             *
             * @param string $token
             * @return \Illuminate\Http\Response
             */
            public function publicGeneratePdf($token)
            {
                // Find the project by share token
                $project = Project::where('share_token', $token)
                                ->where(function ($query) {
                                    $query->whereNull('share_expires_at')
                                        ->orWhere('share_expires_at', '>', now());
                                })
                                ->firstOrFail();
                
                // Load necessary relationships
                $project->load(['placeTakeoffs', 'sinks']);
                
                // Group takeoffs by type
                $takeoffsByType = $project->placeTakeoffs->groupBy('type');
                
                // Create PDF
                $pdf = \PDF::loadView('projects.summary-pdf', [
                    'project' => $project,
                    'takeoffsByType' => $takeoffsByType,
                    'sinks' => $project->sinks,
                    'isPublic' => true
                ]);
                
                // Set paper size and orientation
                $pdf->setPaper('a4', 'portrait');
                
                // Download the PDF
                return $pdf->download($project->name . '_Summary_' . now()->format('Y-m-d') . '.pdf');
            }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}