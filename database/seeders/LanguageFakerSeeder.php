<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LanguageFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $languages = [
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'Spanish', 'code' => 'es'],
            ['name' => 'French', 'code' => 'fr'],
            ['name' => 'German', 'code' => 'de'],
            ['name' => 'Italian', 'code' => 'it'],
        ];

        foreach ($languages as $language) {
            DB::table('languages')->insert([
                'name' => $language['name'],
                'code' => $language['code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}