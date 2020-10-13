<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class LogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $categories = ['error', 'create', 'update', 'delete', 'join'];

        foreach( $categories as $category ){
            DB::table('log_categories')->insert([
                'content' => $category,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
        
    }
}
