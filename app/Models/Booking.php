<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer;
use App\Models\Service;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "bookings";

    protected $fillable = [
        'date',
        'customer_id',
        'service_id',
        'status'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
