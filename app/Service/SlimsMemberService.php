<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;
use App\Models\Member;
use Illuminate\Support\Facades\Log;

class SlimsMemberService
{
    public function sync(): int
    {
        $page = 1;
        $limit = config('services.slims.limit');
        $totalProcessed = 0;

        while (true) {
            $response = Http::timeout(30)->get(
                config('services.slims.url'),
                [
                    'p' => 'api/member',
                    'page' => $page,
                    'limit' => $limit,
                ]
            );

            if (!$response->successful()) {
                Log::error('SLiMS API error', [
                    'page' => $page,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                break;
            }

            $payload = $response->json();
            $members = $payload['data'] ?? [];

            // ⛔ STOP jika data kosong
            if (empty($members)) {
                break;
            }

            $rows = collect($members)->map(fn($item) => [
                'slims_member_id' => $item['member_id'],
                'name' => $item['name'],
                'email' => $item['email'] ?? null,
                'phone' => $item['phone'] ?? null,
                'address' => $item['address'] ?? null,
                'type' => $item['type'] ?? null,
                'register_date' => $item['register_date'] ?? null,
                'expire_date' => $item['expire_date'] ?? null,
                'image' => $item['image'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ])->toArray();

            Member::upsert(
                $rows,
                ['slims_member_id'],
                [
                    'name',
                    'email',
                    'phone',
                    'address',
                    'type',
                    'register_date',
                    'expire_date',
                    'image',
                    'updated_at',
                ]
            );

            $totalProcessed += count($rows);

            // ✅ JIKA DATA < LIMIT → HALAMAN TERAKHIR
            if (count($members) < $limit) {
                break;
            }

            $page++;
        }

        return $totalProcessed;
    }
}
