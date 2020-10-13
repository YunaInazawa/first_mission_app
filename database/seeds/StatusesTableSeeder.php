<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $statuses = ['天才', 'TEST', 'もうちょい', 'もう半分', 'はやくやれ', 'ｷｬﾝﾌﾟﾌｧｲﾔｰNOW'];

        foreach( $statuses as $status ){
            DB::table('statuses')->insert([
                'title' => $status,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
    }
}
