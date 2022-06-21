<?php

namespace App\Http\Livewire\Dashboard\Type;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Admin extends Component
{
    public function render()
    {
        return view('livewire.dashboard.type.admin');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
