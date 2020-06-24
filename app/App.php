<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{

    protected $table = 'apps';

    protected $fillable = ['name' , 'description' , 'icon' , 'creator'];
}
