<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contract extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'client_id',
        'car_name',
        'car_price',
        'interest_value',
        'total_amount',
        'installments_count',
        'installment_amount',
        'start_date',
        'status',
        'notes'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function installments()
    {
        return $this->hasMany(Installment::class);
    }

    public function getPaidAmountAttribute()
{
    return $this->installments
        ->flatMap(fn ($item) => $item->payments)
        ->sum('amount');
}

public function getRemainingAmountAttribute()
{
    return $this->total_amount - $this->paid_amount;
}

}