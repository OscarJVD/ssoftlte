<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rentals';
    protected $fillable = ['start_date', 'end_date', 'total', 'user_id', 'status_id'];
    protected $guarded = ['id'];

    // Relación Muchos(Rental) a Muchos(Movie) One To Many
    public function movies()
    {
        return $this->belongsToMany('App\Models\Movie');
    }

    // Relación Muchos(Rental) -> a Uno(Status)  One To Many
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    // Relación Muchos(Rental) -> a Uno(User) One To Many
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
