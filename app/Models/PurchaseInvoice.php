<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchase_id',
        'invoice_id'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class)->orderBy('created_at', 'desc');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
