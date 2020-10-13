<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class KinokoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        /**
         * ユーザ (OCTOPUS)
         */
        DB::table('users')->insert([
            'name' => 'Octopus of mercy',
            'email' => 'merchant@gmail.com',
            'password' => Hash::make('merchant'),
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * ユーザ (CRAZY KINOKO PERSON)
         */
        DB::table('users')->insert([
            'name' => 'KINOKO is Lovers',
            'email' => 'kinoko_love@gmail.com',
            'password' => Hash::make('kinokokinoko'),
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * ユーザ (People who are HATE at KINOKO)
         */
        DB::table('users')->insert([
            'name' => 'Wishing DEATH of KINOKO',
            'email' => 'kinoko_hate@gmail.com',
            'password' => Hash::make('kinokokinoko'),
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * プロジェクト(Mt.KINOKO)
         */
        DB::table('projects')->insert([
            'name' => 'Mountain of KINOKO',
            'description' => '全生物キノコ魅了計画\n「はじめてのキノコ採集にも役立つ、キノコ採集MAP！（完全版）」\n世界のキノコ料理レシピまとめ\n毒キノコと食用キノコの簡単な見分け方\n',
            'using' => 'TestProjectUsing',
            'created_at' => $now, 
            'updated_at' => $now,
        ]);
    }
}
