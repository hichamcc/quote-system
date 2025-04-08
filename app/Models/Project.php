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
        'customer',
        'attention',
        'phone',
        'email',
        'address',
        'architect',
        'bid_date',
        'plan_date',
        'date_accepted',
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
   
}