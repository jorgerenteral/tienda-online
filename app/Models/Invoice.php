<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'subtotal',
        'tax',
        'total',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'subtotal' => 'float',
        'tax' => 'float',
        'total' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchase_invoices()
    {
        return $this->hasMany(PurchaseInvoice::class, 'invoice_id');
    }
}
