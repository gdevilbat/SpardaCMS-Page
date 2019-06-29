<?php

namespace Gdevilbat\SpardaCMS\Modules\Page\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use DB;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $faker = \Faker\Factory::create();

        DB::table('posts')->insert([
            [
                'post_title' => 'homepage',
                'post_slug' => 'homepage',
                'post_content' => $faker->text,
                'post_excerpt' => $faker->word,
                'post_status' => 'draft',
                'post_type' => 'page',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
