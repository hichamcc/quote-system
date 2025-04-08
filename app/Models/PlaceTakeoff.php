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
        'place',
    ];

    /**
     * Get the project that owns the place takeoff.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the tops for the place takeoff.
     */
    public function tops()
    {
        return $this->hasMany(Top::class);
    }

    /**
     * Get the backsplashes for the place takeoff.
     */
    public function backsplashes()
    {
        return $this->hasMany(Backsplash::class);
    }
}