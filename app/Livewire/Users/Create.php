<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Traits\WithToast;

class Create extends Component
{
    use WithToast;
    public array $form = [
        'name' => '',
        'email' => '',
        'is_admin' => false,
        'password' => '',
        'password_confirmation' => '',
    ];

    public function saveUser(){
        $this->validate([
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|email|unique:users,email',
            'form.password' => 'required|string|min:8|confirmed',
            'form.password_confirmation' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $this->form['name'],
            'email' => $this->form['email'],
            'is_admin' => $this->form['is_admin'],
            'password' => bcrypt($this->form['password']),
        ]);

        $this->reset('form');
        $this->dispatch('close-slideover', 'create-users');
        $this->dispatch('refreshUsers');
        $this->toast('User created successfully.');
    }
    public function render()
    {
        return view('livewire.users.create');
    }
}
