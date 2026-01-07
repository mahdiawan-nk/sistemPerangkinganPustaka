<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Visit extends Model
{
    use HasFactory;
    protected $table = 'visits';
    protected $fillable = [
        'member_id',
        'guest_name',
        'guest_identity',
        'guest_phone',
        'visit_date',
        'visit_time',
        'purpose',
        'visit_type',
        'source',
        'ip_address',
        'user_agent',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function scopeApplyPeriodeFilter(
        Builder $query,
        ?string $periode,
        ?array $rangeDate = null
    ): Builder {
        if (!$periode) {
            return $query;
        }

        // RANGE DATE (SEMESTER)
        if ($periode === 'range_date' && $rangeDate) {
            return $query->whereBetween('visit_date', [
                Carbon::parse($rangeDate['start'])->startOfDay(),
                Carbon::parse($rangeDate['end'])->endOfDay(),
            ]);
        }

        // PRESET PERIODE
        return match ($periode) {
            'today' => $query->whereDate('visit_date', Carbon::today()),

            'this_week' => $query->whereBetween(
                'visit_date',
                [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            ),

            'this_month' => $query->whereMonth('visit_date', Carbon::now()->month)
                ->whereYear('visit_date', Carbon::now()->year),

            'this_year' => $query->whereYear('visit_date', Carbon::now()->year),

            default => $query,
        };
    }

    public function scopeMemberRekap(
        Builder $query,
        ?string $periode = null,
        ?array $rangeDate = null
    ) {
        return $query
            ->applyPeriodeFilter($periode, $rangeDate)
            ->select([
                'member_id',
                'guest_name',
                'guest_identity',
                'guest_phone',
                DB::raw("'member' as type"),
                DB::raw('COUNT(id) as jml'),
            ])
            ->whereNotNull('member_id')
            ->groupBy(
                'member_id',
                'guest_name',
                'guest_identity',
                'guest_phone'
            );
    }
    public function scopeGuestRekap(
        Builder $query,
        ?string $periode = null,
        ?array $rangeDate = null
    ) {
        return $query
            ->applyPeriodeFilter($periode, $rangeDate)
            ->select([
                DB::raw('NULL as member_id'),
                DB::raw("COALESCE(guest_name, 'Guest Tidak Dikenal') as guest_name"),
                DB::raw("COALESCE(guest_identity, '-') as guest_identity"),
                DB::raw("COALESCE(guest_phone, '-') as guest_phone"),
                DB::raw("'guest' as type"),
                DB::raw('COUNT(id) as jml'),
            ])
            ->whereNull('member_id')
            ->groupBy(
                'guest_name',
                'guest_identity',
                'guest_phone'
            );
    }


}
