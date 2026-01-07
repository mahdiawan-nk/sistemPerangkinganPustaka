<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\Member;
use App\Traits\WithToast;
class Update extends Component
{
    use WithToast;
     public $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
        'type' => '',
    ];

    
    public $types = [];

    public $selectedId = null;

    public function mount(Member $member = null)
    {
        $this->selectedId = $member?->id;
        $this->form['name'] = $member?->name;
        $this->form['email'] = $member?->email;
        $this->form['phone'] = $member?->phone;
        $this->form['address'] = $member?->address;
        $this->form['type'] = $member?->type;
        $this->types = $this->getTypesProperty();
    }

    protected function getTypesProperty()
    {
        return Member::select('type')->distinct()->pluck('type');
    }

    public function updateMember()
    {
       
        Member::where('id', $this->selectedId)->update($this->form);

        $this->reset('form');

        $this->dispatch('close-slideover', 'update-member');

        $this->toast('Member saved successfully');
    }
    public function render()
    {
        return view('livewire.member.update');
    }
}
