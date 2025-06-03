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
            'profit' => 'Profit',
            // New service prices
            'vein_exact_match' => 'Vein Exact Match',
            'electrical_cutout' => 'Electrical Cutout',
            'demo' => 'Demo'
        ];
    }

    // Get service prices specifically (for easy access in forms)
    public static function getServicePrices()
    {
        return [
            'vein_exact_match' => 'Vein Exact Match',
            'electrical_cutout' => 'Electrical Cutout',
            'demo' => 'Demo'
        ];
    }

    // Helper method to get a service price for a specific customer type
    public function getServicePrice($service, $customerType = 'residential')
    {
        $field = $customerType . '_' . $service;
        return $this->$field ?? 0;
    }
}