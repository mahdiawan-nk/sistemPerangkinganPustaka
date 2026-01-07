<?php

namespace Database\Factories;

use App\Models\Visit;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Visit::class;

    public function definition(): array
    {
        return [
            // member_id opsional (kadang null)
            'member_id' => $this->faker->boolean(60)
                ? Member::inRandomOrder()->value('id')
                : null,

            'guest_name' => $this->faker->name(),
            'guest_identity' => $this->faker->numerify('################'),
            'guest_phone' => $this->faker->phoneNumber(),

            'visit_date' => $this->faker->dateTimeBetween(
                '2025-09-01',
                '2026-04-30'
            )->format('Y-m-d'),
            'visit_time' => $this->faker
                ->dateTimeBetween('today 08:00', 'today 15:00')
                ->format('H:i'),

            'purpose' => $this->faker->randomElement([
                'Membaca buku',
                'Meminjam buku',
                'Mengembalikan buku',
                'Penelitian',
                'Kunjungan umum',
            ]),

            'visit_type' => $this->faker->randomElement([
                'member',
                'guest',
            ]),

            'source' => $this->faker->randomElement([
                'barcode',
                'manual',
            ]),

            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
        ];
    }

    public function guest(): static
    {
        return $this->state(fn() => [
            'member_id' => null,
            'visit_type' => 'guest',
            'guest_name' => $this->faker->name(),
            'guest_identity' => $this->faker->numerify('################'),
            'guest_phone' => $this->faker->phoneNumber(),
        ]);
    }

    /**
     * State khusus jika ingin dipastikan sebagai member
     */
    public function member(): static
    {
        return $this->state(function () {
            $member = Member::query()->inRandomOrder()->first();

            return [
                'member_id' => $member->id,
                'visit_type' => 'member',
                'guest_name' => $member->name,
                'guest_identity' => $member->slims_member_id,
                'guest_phone' => $member->phone,
            ];
        });
    }

}
