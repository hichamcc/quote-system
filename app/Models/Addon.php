<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'type',
        'sink_model',
        'sink_name',
        'sink_quantity',
        'sink_price',
        'edge',
        'edge_type',
        'edge_price',
        'plumbing',
        'plumbing_details',
        'plumbing_price',
        'bracket_model',
        'bracket_name',
        'bracket_quantity',
        'bracket_price',
        'demo',
        'demo_price',
        'vein_exact_match',
        'vein_exact_match_price',
        'electrical_cutout',
        'electrical_cutout_quantity',
        'electrical_cutout_price',
    ];

    protected $casts = [
        'edge' => 'boolean',
        'plumbing' => 'boolean',
        'demo' => 'boolean',
        'vein_exact_match' => 'boolean',
        'electrical_cutout' => 'boolean',
        'sink_quantity' => 'integer',
        'sink_price' => 'decimal:2',
        'edge_price' => 'decimal:2',
        'plumbing_price' => 'decimal:2',
        'bracket_quantity' => 'integer',
        'bracket_price' => 'decimal:2',
        'demo_price' => 'decimal:2',
        'vein_exact_match_price' => 'decimal:2',
        'electrical_cutout_quantity' => 'integer',
        'electrical_cutout_price' => 'decimal:2',
    ];

    /**
     * Get the project that owns the addon.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Calculate total addon cost
     */
    public function getTotalCostAttribute()
    {
        $total = 0;

        // Add sink price if provided (multiply by quantity)
        if ($this->sink_price && $this->sink_quantity) {
            $total += $this->sink_price * $this->sink_quantity;
        }

        // Add conditional prices if options are selected
        if ($this->edge && $this->edge_price) {
            $total += $this->edge_price;
        }

        if ($this->plumbing && $this->plumbing_price) {
            $total += $this->plumbing_price;
        }

        if ($this->bracket_price && $this->bracket_quantity) {
            $total += $this->bracket_price * $this->bracket_quantity;
        }

        if ($this->demo && $this->demo_price) {
            $total += $this->demo_price;
        }

        if ($this->vein_exact_match && $this->vein_exact_match_price) {
            $total += $this->vein_exact_match_price;
        }

        if ($this->electrical_cutout && $this->electrical_cutout_price && $this->electrical_cutout_quantity) {
            $total += $this->electrical_cutout_price * $this->electrical_cutout_quantity;
        }

        return $total;
    }
}