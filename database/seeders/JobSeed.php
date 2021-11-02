<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class JobSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 20) as $index){
            DB::table('jobs')->insert([
                'title' => $faker->jobTitle,
                'description' => $faker->text,
                'min_salary' => (mt_rand(1000.00, 5000.00)),
                'max_salary' => (mt_rand(3500.00, 50000.00)),
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]);
        }
    }
}
