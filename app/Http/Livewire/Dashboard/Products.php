<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Product;
use App\Traits\WithAlerts;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination, WithAlerts;

    protected $paginationTheme = 'bootstrap';

    public $updateId;
    public $name;
    public $price;
    public $tax;

    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric',
        'tax' => 'required|numeric',
    ];

    protected $messages = [
        'name.required' => 'Debes ingresar el Nombre del Producto.',
        'price.required' => 'Debes ingresar el Precio del Producto.',
        'price.numeric' => 'El Precio del Producto debe ser un valor numérico.',
        'tax.required' => 'Debes ingresar el Impuesto del Producto.',
        'tax.numeric' => 'El Impuesto del Producto debe ser un valor numérico.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.dashboard.products', [
            'products' => Product::orderBy('created_at', 'desc')->paginate(10)
        ])->layout('layouts.dashboard');
    }

    public function addProduct()
    {
        $this->resetForm();

        $this->emit('addProduct');
    }

    public function createProduct()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'tax' => $this->tax,
        ]);

        $this->resetForm();
        $this->emit('productCreated');

        $this->success = 'Producto creado correctamente.';
    }

    public function editProduct(Product $product)
    {
        $this->updateId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->tax = $product->tax;

        $this->emit('editProduct');
    }

    public function updateProduct(Product $product)
    {
        $this->validate();

        $product->update([
            'name' => $this->name,
            'price' => $this->price,
            'tax' => $this->tax,
        ]);

        $this->resetForm();
        $this->emit('productUpdated');

        $this->success = 'Producto actualizado correctamente.';
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        $this->success = 'Producto eliminado correctamente.';
    }

    public function resetForm()
    {
        $this->reset('updateId');
        $this->reset('name');
        $this->reset('price');
        $this->reset('tax');
    }
}
