<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table='books';

    protected $fillable=['title, release_date'];


    public  function author()
    {
        return $this->belongsTo('App/Author');
    }
}
