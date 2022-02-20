<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    //set id không phải int-> string
    protected $primaryKey = 'Id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'invoices';

    protected $fillable = [
        'AccountId', 'IssueDate', 'Total', 'ShippingAddress', 'PhoneShipping', 'Discount', 'Status',
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function status_order()
    {
        return $this->belongsTo(OrderStatus::class, 'order_statuses_id', 'id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payments_id', 'id');
    }
}
