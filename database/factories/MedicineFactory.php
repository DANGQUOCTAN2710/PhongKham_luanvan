<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'dosage' => $this->faker->randomElement(['250mg', '500mg', '1000mg']),
            'unit' => $this->faker->randomElement(['Viên', 'Gói', 'Chai', 'Lọ']),
            'instructions' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 5000, 50000),
            'stock' => $this->faker->numberBetween(0, 1000),
            'status' => 'Còn hàng',
        ];
    }
}
