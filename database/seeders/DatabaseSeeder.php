<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'Sem categoria',
            'slug' => 'sem-categoria',
            'color' => '#cccccc',
        ]);

        DB::table('settings')->insert([
            'key' => 'instagram_api_key',
            'value' => Crypt::encryptString('defaut_value')
        ]);

        DB::table('settings')->insert([
            'key' => 'instagram_user_id',
            'value' => Crypt::encryptString('defaut_value')
        ]);
    }
}
