<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\PurchaseInvoice;
use App\Models\User;
use App\Traits\WithAlerts;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class Purchases extends Component
{
    use WithPagination, WithAlerts;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $clients = User::whereHas('purchases', function (Builder $query) {
            $query->doesntHave('invoice');
        })->with('purchases')->paginate(10);

        return view('livewire.dashboard.purchases', [
            'clients' => $clients
        ])->layout('layouts.dashboard');
    }

    public function invoice(User $user)
    {
        $this->resetSuccess();

        $subtotal = 0;
        $tax = 0;
        $total = 0;

        $invoice = $user->invoices()->create([
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0,
        ]);

        $purchases = $user->purchases()->doesntHave('invoice')->get();

        foreach ($purchases as $purchase) {
            $product = $purchase->product;

            $subtotal += $product->price - $product->tax_charged;
            $tax += $product->tax_charged;
            $total += $product->price;

            PurchaseInvoice::create([
                'purchase_id' => $purchase->id,
                'invoice_id' => $invoice->id
            ]);
        }

        $invoice->update([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);

        $this->success = '¡Compras facturadas exitosamente!';
    }
}
