<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'sink_area',
        'brand',
        'model',
        'price',
        'quantity',
    ];

    /**
     * Get the project that owns the sink.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}