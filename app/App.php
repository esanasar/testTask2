<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model;

class App extends Model
{

    protected $connection= 'mongodb';
    protected $collection = 'apps';

    protected $fillable = ['name' , 'description' , 'icon' , 'creator'];
}
