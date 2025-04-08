<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backsplash extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_takeoff_id',
        'elevation',
        'detail',
        'area',
        'color',
        'supplier_brand',
        'type',
        'unit_qty',
        'thickness',
        'length_inches',
        'width_inches',
        'sqft_per_unit',
        'total_sqft_counter_top',
        'polished_edge_inches',
        'polished_edge_lnft',
        'total_pol_edge_lnft',
    ];

    /**
     * Get the place takeoff that owns the backsplash.
     */
    public function placeTakeoff()
    {
        return $this->belongsTo(PlaceTakeoff::class);
    }
}