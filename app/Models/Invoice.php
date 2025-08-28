<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'customer',
        'amount',
        'tax_amount',
        'status',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'amount'       => 'decimal:2',
        'tax_amount'   => 'decimal:2',
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }

    public function getTotalAmountAttribute(): float
    {
        return $this->amount + $this->tax_amount;
    }

    public function getTotalPaidAttribute(): float
    {
        return $this->payments()->sum('amount_paid');
    }

    public function getBalanceAttribute(): float
    {
        return $this->total_amount - $this->total_paid;
    }

    public function getIsPaidAttribute(): bool
    {
        return abs($this->balance) < 0.01;
    }
}
