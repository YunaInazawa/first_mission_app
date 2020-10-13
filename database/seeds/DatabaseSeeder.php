<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LogCategoriesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ElementsTableSeeder::class);
        $this->call(TestTableSeeder::class);
        $this->call(KinokoTableSeeder::class);
    }
}
