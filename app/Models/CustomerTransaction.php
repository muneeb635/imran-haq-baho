<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'bill_no',
        'bill_picture',
        'in',
        'out',
        'remaining',
        'customer_id',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
