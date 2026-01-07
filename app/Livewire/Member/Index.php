<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Member;
use App\Traits\WithToast;
use Flux\Flux;
class Index extends Component
{
    use WithPagination, WithToast;

    // protected $paginationTheme = 'daisyui';

    public $search = '';
    public $perPage = 10;

    public $filterType = '';

    public $types = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'perPage' => ['except' => 10],
        'page' => ['except' => 1],
    ];

    public $selectedId = null;

    public function mount()
    {
        $this->types = $this->getTypesProperty();
    }

    protected function getTypesProperty()
    {
        return Member::select('type')->distinct()->pluck('type');
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit(Member $member)
    {
        $this->selectedId = $member->id;
        $this->dispatch('open-slideover', 'update-member');
    }
    public function openDelete($memberId)
    {
        $this->selectedId = $memberId;
        Flux::modal('confirm')->show();
    }
    public function delete(Member $member)
    {
        // $member->delete();
        Flux::modal('confirm')->close();
        $this->toast('Member deleted successfully');
    }

    public function render()
    {
        $members = Member::query()
            ->when($this->filterType, fn($q) => $q->where('type', $this->filterType))
            ->when(
                $this->search,
                fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
            )
            ->orderBy('name')
            ->paginate($this->perPage);
        return view('livewire.member.index', [
            'members' => $members,
        ]);
    }
}
