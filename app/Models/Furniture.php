<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      description="Furniture model",
 *      title="Furniture model",
 *      required={"name", "price"},
 *      @OA\Xml(
 *          name="Furniture"
 *      )
 *  )
 */

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
        'category',
        'vendor',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function date_adder() {
    //     return $this->belongsTo(User::class, 'created_by', 'id');
    // }
}
