<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Validation\Rules\Password;
class Login extends Component
{
    public $email, $password;
    public $errorMessage;

    // You don't need to define 'password' validation rule in $rules anymore
    protected $rules = [
        'email' => 'required|email|string', // Keep email validation as static
    ];

    public function updatedEmail($value)
    {
        $this->email = strtolower($value); // Convert email to lowercase
    }

    public function login()
    {
        // Dynamically apply password rule validation
        $this->validate([
            'email' => 'required|email|string',
            'password' => ['required', Password::defaults()],
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('dashboard'); // Redirect after successful login
        } else {
            $this->errorMessage = 'Invalid credentials. Please try again.';
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
