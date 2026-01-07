<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Visit;
use App\Models\Member;
use Carbon\Carbon;

class Stats extends Component
{
    // === TOTAL MEMBER ===
    public int $totalMembers = 0;

    // === HARI INI ===
    public int $todayTotal = 0;
    public int $todayMember = 0;
    public int $todayGuest = 0;

    // === BULAN INI ===
    public int $monthTotal = 0;
    public int $monthMember = 0;
    public int $monthGuest = 0;

    // === TAHUN INI ===
    public int $yearTotal = 0;
    public int $yearMember = 0;
    public int $yearGuest = 0;

    /**
     * Polling setiap 30 detik
     */
    protected $listeners = [
        'refreshStats' => '$refresh',
    ];

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats(): void
    {
        $today = Carbon::today();
        $now = Carbon::now();

        // === TOTAL MEMBER ===
        $this->totalMembers = Member::count();

        // === HARI INI ===
        $this->todayMember = Visit::whereDate('visit_date', $today)
            ->whereNotNull('member_id')
            ->count();

        $this->todayGuest = Visit::whereDate('visit_date', $today)
            ->whereNull('member_id')
            ->count();

        $this->todayTotal = $this->todayMember + $this->todayGuest;

        // === BULAN INI ===
        $this->monthMember = Visit::whereYear('visit_date', $now->year)
            ->whereMonth('visit_date', $now->month)
            ->whereNotNull('member_id')
            ->count();

        $this->monthGuest = Visit::whereYear('visit_date', $now->year)
            ->whereMonth('visit_date', $now->month)
            ->whereNull('member_id')
            ->count();

        $this->monthTotal = $this->monthMember + $this->monthGuest;

        // === TAHUN INI ===
        $this->yearMember = Visit::whereYear('visit_date', $now->year)
            ->whereNotNull('member_id')
            ->count();

        $this->yearGuest = Visit::whereYear('visit_date', $now->year)
            ->whereNull('member_id')
            ->count();

        $this->yearTotal = $this->yearMember + $this->yearGuest;
    }

    public function render()
    {
        return view('livewire.dashboard.stats'); // 🔥 polling tiap 30 detik
    }
}
