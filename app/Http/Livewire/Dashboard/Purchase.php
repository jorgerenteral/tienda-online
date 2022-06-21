<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Product;
use App\Traits\WithAlerts;
use Livewire\Component;

class Purchase extends Component
{
    use WithAlerts;

    public $product_id;
    public $force = false;

    protected $rules = [
        'product_id' => 'required|exists:products,id',
    ];

    protected $messages = [
        'product_id.required' => 'Debes elegir el producto que vas a comprar.',
        'product_id.exists' => 'El producto que elegiste no existe.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->resetSuccess();
        $this->validate();

        $user = request()->user();

        if ($user->purchases()->where('product_id', $this->product_id)->exists() && !$this->force) {
            $this->warning = 'Ya has comprado este producto, ¿Quieres volver a comprarlo?';
            return;
        }

        $purchase = $user->purchases()->create([
            'product_id' => $this->product_id,
        ]);

        $this->success = '¡Has comprado el producto ' . $purchase->product->name . ' exitosamente!';

        $this->resetForm();
    }

    public function forcePurchase()
    {
        $this->force = true;

        $this->submit();
    }

    public function render()
    {
        return view('livewire.dashboard.purchase', [
            'products' => Product::get()
        ])->layout('layouts.dashboard');
    }

    public function resetForm()
    {
        $this->reset('warning');
        $this->reset('product_id');
        $this->reset('force');
    }
}
