<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    //set id không phải int-> string
    protected $primaryKey = 'Id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'accounts';

    protected $fillable = [
        'Username', 'Email', 'Fullname', 'Address1', 'Address2', 'Phone', 'Avatar', 'Status',
    ];
}