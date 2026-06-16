<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Installment extends Model
    
{  use HasFactory, SoftDeletes;
    protected $fillable = [
        'contract_id',
        'installment_number',
        'amount',
        'due_date',
        'status'
    ];

    protected $casts = [
    'due_date' => 'date',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}