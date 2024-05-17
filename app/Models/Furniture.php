<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Furniture extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = "furnitures";
    protected $fiillable = [
        'name',
        'description',
        'image',
        'price',
        'created_at',
        'updated_at',
    ];

    // public function date_adder() {
    //     return $this->belongsTo(User::class, 'created_by', 'id');
    // }
}
