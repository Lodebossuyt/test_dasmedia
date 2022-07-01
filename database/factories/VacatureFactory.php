<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacature>
 */
class VacatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companys = Company::pluck('id')->toArray();
        return [
            'title'=>$this->faker->sentence($nbwords = 6, $variableNbWords = true),
            'company_id'=>$this->faker->randomElement($companys),
        ];
    }
}
