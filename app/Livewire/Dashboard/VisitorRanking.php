<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class VisitorRanking extends Component
{
    public string $periode = 'this_month'; // month | year

    public function getTopThreeProperty()
    {
        $member = Visit::memberRekap($this->periode);
        $guest = Visit::guestRekap($this->periode);

        return DB::query()
            ->fromSub($member->unionAll($guest), 'rekap')
            ->select(
                'guest_name',
                'guest_identity',
                'type',
                DB::raw('SUM(jml) as total')
            )
            ->groupBy('guest_name', 'guest_identity', 'type')
            ->orderByDesc('total')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.visitor-ranking');
    }
}
