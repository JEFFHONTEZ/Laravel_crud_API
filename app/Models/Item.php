<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // protected $table = 'items';
    protected $connection = 'mongodb';
    protected $collection = 'items';

    protected $fillable = [
        'name',
        'description',
        'color',
    ];
}
