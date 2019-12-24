<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    protected $table = 'packet';
    protected $fillable = [
    	'code', 'link', 'name', 'packet', 'price', 'registration', 'source', 'cat'
    ];
}
