<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'project_type',
        'customer',
        'attention',
        'phone',
        'email',
        'address',
        'architect',
        'bid_date',
        'plan_date',
        'date_accepted',
        'factor_fabrication',
        'factor_edge_polish',
        'factor_miter',
        'factor_sink_cutout', 
        'factor_cooktop_cutout',
        'factor_template',
        'factor_installation',
        'factor_overhead',
        'factor_waste',
        'factor_profit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'bid_date' => 'date',
        'plan_date' => 'date',
        'date_accepted' => 'date',
    ];

    /**
     * Get the user that owns the project.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the place takeoffs for the project.
     */
    public function placeTakeoffs()
    {
        return $this->hasMany(PlaceTakeoff::class);
    }
    
    /**
     * Get the attachments for the project.
     */
    public function attachments()
    {
        return $this->hasMany(ProjectAttachment::class);
    }

    /**
     * Get the sinks for the project.
     */
    public function sinks()
    {
        return $this->hasMany(Sink::class);
    }


     /**
     * Calculate the sqft cost based on material price and waste factor
     */
    public function calculateSqftCost($materialPrice)
    {
        $wasteFactor = 1 + ($this->factor_waste / 100);
        return $materialPrice * $wasteFactor;
    }
    
    /**
     * Calculate the fabrication cost for an area
     */
    public function calculateFabricationCost($sqft) 
    {
        return $sqft * $this->factor_fabrication;
    }
    
    /**
     * Calculate the edge polish cost
     */
    public function calculateEdgePolishCost($linearFeet)
    {
        return $linearFeet * $this->factor_edge_polish;
    }
    
    /**
     * Calculate the miter cost
     */
    public function calculateMiterCost($linearFeet)
    {
        return $linearFeet * $this->factor_miter;
    }
    
    /**
     * Calculate sink cutout cost
     */
    public function calculateSinkCutoutCost($quantity)
    {
        return $quantity * $this->factor_sink_cutout;
    }
    
    /**
     * Calculate cooktop cutout cost
     */
    public function calculateCooktopCutoutCost($quantity)
    {
        return $quantity * $this->factor_cooktop_cutout;
    }
    
    /**
     * Calculate template cost
     */
    public function calculateTemplateCost($sqft)
    {
        return $sqft * $this->factor_template;
    }
    
    /**
     * Calculate installation cost
     */
    public function calculateInstallationCost($sqft)
    {
        return $sqft * $this->factor_installation;
    }
    
    /**
     * Calculate overhead
     */
    public function calculateOverhead($subtotal)
    {
        return $subtotal * ($this->factor_overhead / 100);
    }
    
    /**
     * Calculate profit
     */
    public function calculateProfit($subtotal)
    {
        return $subtotal * ($this->factor_profit / 100);
    }
    
    /**
     * Set pricing factors based on project type from the current pricing factors
     */
    public function setPricingFactors()
    {
        $pricingFactor = PricingFactor::first();
        $type = $this->project_type;
        
        $this->factor_fabrication = $pricingFactor->{$type . '_fabrication'};
        $this->factor_edge_polish = $pricingFactor->{$type . '_edge_polish'};
        $this->factor_miter = $pricingFactor->{$type . '_miter'};
        $this->factor_sink_cutout = $pricingFactor->{$type . '_sink_cutout'};
        $this->factor_cooktop_cutout = $pricingFactor->{$type . '_cooktop_cutout'};
        $this->factor_template = $pricingFactor->{$type . '_template'};
        $this->factor_installation = $pricingFactor->{$type . '_installation'};
        $this->factor_overhead = $pricingFactor->{$type . '_overhead'};
        $this->factor_waste = $pricingFactor->{$type . '_waste'};
        $this->factor_profit = $pricingFactor->{$type . '_profit'};
        
        $this->save();
    }
}