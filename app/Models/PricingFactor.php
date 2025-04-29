<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingFactor extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Allow mass assignment for all other fields

    // Get a static list of factor names for displaying in forms
    public static function getFactorNames()
    {
        return [
            'fabrication' => 'Fabrication',
            'edge_polish' => 'Edge Polish', 
            'miter' => 'Miter',
            'sink_cutout' => 'Sink C/O and Polish',
            'cooktop_cutout' => 'Cooktop C/O',
            'template' => 'Template',
            'installation' => 'Installation',
            'overhead' => 'OH',
            'waste' => 'Waste',
            'profit' => 'Profit'
        ];
    }
}