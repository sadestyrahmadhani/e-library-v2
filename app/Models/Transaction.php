<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
