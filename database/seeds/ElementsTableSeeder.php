<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class ElementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $elements = ['Buttom', 'Label', 'TextBox', 'RadioButtom', 'CheckBox'];

        foreach( $elements as $element ){
            DB::table('elements')->insert([
                'name' => $element,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
