<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    //set id không phải int-> string
    protected $primaryKey = 'Id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'carts';

    protected $fillable = [
        'AccountId', 'ProductId', 'Quantity',
    ];
}