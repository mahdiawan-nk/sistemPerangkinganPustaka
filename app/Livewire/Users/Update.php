<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Traits\WithToast;

class Update extends Component
{
    use WithToast;

    public $selectedId;
    public array $form = [
        'name' => '',
        'email' => '',
        'is_admin' => false,
        'password' => '',
        'password_confirmation' => '',
    ];
    public bool $updatePassword = false;
    public function mount($user = null)
    {
        $user = User::find($user);
        if ($user) {
            $this->selectedId = $user->id;
            $this->form['name'] = $user->name;
            $this->form['email'] = $user->email;
            $this->form['is_admin'] = $user->is_admin;
        }
    }
    public function saveUser()
    {
        if ($this->updatePassword) {
            $this->validate([
                'form.password' => 'required|string|min:8|confirmed',
                'form.password_confirmation' => 'required|string|min:8',
            ]);


            $this->form['password'] = bcrypt($this->form['password']);
        }

        unset($this->form['password_confirmation']);

        User::where('id', $this->selectedId)->update($this->form);

        $this->reset('form');
        $this->dispatch('close-slideover', 'update-users');
        $this->dispatch('refreshUsers');
        $this->toast('User updated successfully.');
    }
    public function render()
    {
        return view('livewire.users.update');
    }
}
