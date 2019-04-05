<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'type_id'
    ];

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute', 'products_attributes')->withPivot('value');
        //return $this->hasMany('App\Models\Attribute', 'products_attributes')->withPivot('value');
    }

    public function type()
    {
        return $this->hasOne('App\Models\Type', 'id', 'type_id');
    }
}
