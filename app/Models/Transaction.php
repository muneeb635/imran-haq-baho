<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'bill_no',
        'bill_picture',
        'in',
        'out',
        'remaining',
        'supplier_id',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
