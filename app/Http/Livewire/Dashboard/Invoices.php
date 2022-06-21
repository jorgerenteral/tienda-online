<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class Invoices extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.dashboard.invoices', [
            'invoices' => Invoice::orderBy('created_at', 'desc')->paginate(10)
        ])->layout('layouts.dashboard');
    }
}
