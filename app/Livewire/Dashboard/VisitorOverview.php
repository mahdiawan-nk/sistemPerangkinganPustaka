<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Visit;
use Carbon\Carbon;
use Livewire\Attributes\On;
use App\Traits\WithToast;
class VisitorOverview extends Component
{
    use WithToast;
    public int $limit = 10;

    public function mount(){
        // $this->refresh();  
    }
    #[On('echo:visitors,.visitor.created')]
    public function refresh()
    {
        $this->getVisitorsProperty();
    }
   
    public function getVisitorsProperty()
    {
        return Visit::query()
            ->whereDate('visit_date', Carbon::today())
            ->orderBy('id', 'desc') // terbaru dulu
            ->limit($this->limit)
            ->get();
    }
    public function render()
    {
        return view('livewire.dashboard.visitor-overview');
    }
}
