<?php

namespace Database\Seeders;

use App\Models\Vacature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vacatures = Vacature::factory()->count(2000)->create();
        foreach($vacatures as $vacature){
            if($vacature->isPrime()){
                $vacature->label = 1;
                $vacature->update();
            }
            if($vacature->isTenFold()){
                $vacature->apply = 1;
                $vacature->update();
            }
        }
    }
}
