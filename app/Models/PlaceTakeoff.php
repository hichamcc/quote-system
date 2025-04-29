<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceTakeoff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'amg_job_number',
        'type',
        'material_name',
        'material_price',
        'supplier',
        'area',
        'piece_number',
        'length',
        'width',
        'polished_edge_length',
        'miter_edge_length',
        'sink_cutout',
        'cooktop_cutout',
    ];

    /**
     * Get the project that owns the place takeoff.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}