<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReport extends Model
{
    protected $fillable = [
        'client_id',
        'city_id',
        'report_date',
        'phone',
        'earned_amount',
        'fees',
        'completed_orders_count',
        'rejected_orders_count',
        'delivery_hours',
        'vehicle_type',
        'payment_image',
        'notes',
        'status',
        'allow_resubmit',
    ];

    protected $casts = [
        'report_date' => 'date',
        'earned_amount' => 'decimal:2',
        'fees' => 'decimal:2',
        'completed_orders_count' => 'integer',
        'rejected_orders_count' => 'integer',
        'delivery_hours' => 'decimal:2',
        'allow_resubmit' => 'boolean',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}