<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Invoice as ModelsInvoice;
use Livewire\Component;

class Invoice extends Component
{
    public $invoice;

    public function mount(ModelsInvoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.dashboard.invoice')->layout('layouts.dashboard');
    }
}
