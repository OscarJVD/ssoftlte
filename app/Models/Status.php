<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['name', 'type_status_id'];
    protected $guarded = ['id'];

    // Relación Uno(Status) -> a Muchos(User)
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function roles()
    {
        return $this->hasMany('App\Models\Role');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    // Relación Uno(Status) -> a Muchos(User)
    public function movies()
    {
        return $this->hasMany('App\Models\Movie');
    }

    // Relación Uno(Status) -> a Muchos(Rental)
    public function rentals()
    {
        return $this->hasMany('App\Models\Rental');
    }

    public function type_status()
    {
        return $this->belongsTo('App\Models\TypeStatus');
    }
}
