<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //set id không phải int-> string
    protected $primaryKey = 'Id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'products';

    protected $fillable = [
        'Name', 'Price', 'Stock', 'Date', 'Image', 'ProductTypeId', 'Description', 'Status'
    ];
    public function Category()
    {
        return $this->belongsTo(ProductType::class,'ProductTypeId','Id');
    }
}