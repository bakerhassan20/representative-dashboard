<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', "%$term%");
    }

    public function dailyReports()
{
    return $this->hasMany(DailyReport::class);
}


}