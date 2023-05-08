<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            $category_id = rand(1, 20); // Chọn ngẫu nhiên category_id từ 1 đến 10
            DB::table('songs')->insert([
                'image' => 'naruto.jpg',
                'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
                'artist' => $faker->name,
                'category_id' => $category_id,
                'length' => rand(120, 600), // Chọn ngẫu nhiên độ dài từ 2 phút đến 10 phút
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}