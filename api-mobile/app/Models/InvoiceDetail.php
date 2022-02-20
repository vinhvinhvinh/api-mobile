<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoice_details';

    protected $fillable = [
        'InvoiceId', 'ProductId', 'Quantity', 'Price',
    ];
    public function products()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }
}