<?php

namespace Database\Factories;

use App\Models\obat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\obat>
 */
class obatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = obat::class;

    public function definition()
    {
        return [
            'id' => fake()->unique()->regexify('[A-Z]{3}[0-10]{3}'),
            'nama_obat' => $this->faker->word,
            'nama_produsen' => $this->faker->word,
            'stok' => $this->faker->randomDigit(),
            'tgl_kadaluarsa' => $this->faker->date(),
            'dosis' => $this->faker->randomDigit(),
            'harga_jual' => $this->faker->randomDigit(),
            'harga_beli' => $this->faker->randomDigit(),
            'user_id' => fake()->randomDigit(),
            'rak_id' => fake()->unique()->randomDigit(['1','2','3','4']),
        ];
    }
}
