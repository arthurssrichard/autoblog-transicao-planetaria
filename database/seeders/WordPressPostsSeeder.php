<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class WordPressPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Caminho do arquivo JSON
        $json = File::get(database_path('seeders/wordpress_posts.json'));

        // Decodifica o JSON
        $decoded = json_decode($json, true);
        $posts = $decoded[2]['data'];

        // Insere os posts na tabela 'posts'
        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'title' => $post['post_title'],
                'body' => $post['post_content'],
                'slug' => $post['post_name'],
                'published_at' => $post['post_date'],
                'created_at' => $post['post_date'],
                'updated_at' => $post['post_date'],
                'category_id' => 2,
                'user_id' => 1,
                'hidden' => 0,
                'featured' => 0
            ]);
        }
    }
}
