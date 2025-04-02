<?php

namespace Database\Factories;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Clinic::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'user_id' => User::factory()->create(['role' => 'doctor'])->id,
            'status' => $this->faker->randomElement(['Chờ duyệt', 'Bị từ chối', 'Đang hoạt động']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
