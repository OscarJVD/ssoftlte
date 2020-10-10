<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $fillable = ['name', 'description', 'user_id', 'status_id'];
    protected $guarded = ['id'];

    // Relación Muchos(Movie) a Muchos(Category)
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    // Relación Muchos(Movie) a Muchos(Category)
    public function rentals()
    {
        return $this->belongsToMany('App\Models\Rental');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
}
