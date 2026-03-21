<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'designation'=>$this->faker->word(),
            'prix'=>$this->faker->randomFloat(2,10,1000),
            'quantite_stock'=>$this->faker->numberBetween(0,50),
        ];
    }
}
