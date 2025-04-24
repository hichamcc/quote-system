<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAttachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'filename',
        'path',
        'original_filename',
        'mime_type',
        'size',
        'description',
    ];

    /**
     * Get the project that owns the attachment.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}