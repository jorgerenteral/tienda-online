<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\WithAlerts;
use Livewire\Component;

class Register extends Component
{
    use WithAlerts;

    public $email;
    public $name;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed'
    ];

    protected $messages = [
        'name.required' => 'Debes ingresar tu nombre.',
        'email.required' => 'Debes ingresar tu correo electrónico.',
        'email.email' => 'Debes ingresar un correo electrónico válido.',
        'password.required' => 'Debes ingresar tu contraseña.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->resetError();

        $this->validate();

        if (User::whereEmail($this->email)->exists()) {
            return $this->error = 'El correo electrónico ya esta registrado.';
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();

        session()->flash('succesfull_register', '¡Registro exitoso! Ya puedes iniciar sesión con los datos que te registraste.');

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
