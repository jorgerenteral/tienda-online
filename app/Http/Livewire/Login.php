<?php

namespace App\Http\Livewire;

use App\Traits\WithAlerts;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    use WithAlerts;

    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
        'remember' => 'nullable',
    ];

    protected $messages = [
        'email.required' => 'Debes ingresar tu correo electrónico.',
        'email.email' => 'Debes ingresar un correo electrónico válido.',
        'password.required' => 'Debes ingresar tu contraseña.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->resetError();
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return $this->error = 'El correo electrónico o la contraseña son incorrectos.';
        }

        request()->session()->regenerate();

        return redirect()->route('dashboard.home');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
