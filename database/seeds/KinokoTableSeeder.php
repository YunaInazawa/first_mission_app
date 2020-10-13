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
         * ユーザ (you)
         */
        DB::table('users')->insert([
            'name' => 'you',
            'email' => 'you@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

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
            'description' => "全生物キノコ魅了計画\n「はじめてのキノコ採集にも役立つ、キノコ採集MAP！（完全版）」\n「世界のキノコ料理レシピまとめ」\n「毒キノコと食用キノコの簡単な見分け方」\n",
            'using' => '愛',
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * メンバ
         */
        $memberNames = ['KINOKO is Lovers', 'Wishing DEATH of KINOKO', 'Octopus of mercy', 'you'];
        $memberRoles = ['代表', '一般', '一般', '一般'];
        $memberJoins = [1, 1, null, 0];
        $project_id = DB::table('projects')->where('name', 'Mountain of KINOKO')->first()->id;
        for( $i = 0; $i < count($memberNames); $i++ ){
            $user_id = DB::table('users')->where('name', $memberNames[$i])->first()->id;
            $role_id = DB::table('roles')->where('name', $memberRoles[$i])->first()->id;
            DB::table('members')->insert([
                'project_id' => $project_id,
                'user_id' => $user_id,
                'role_id' => $role_id,
                'is_join' => $memberJoins[$i],
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }

        /**
         * シーン
         */
        $sceneNames = ['TOP', 'KINOKOlist', 'KINOKOrecipe', 'KINOKO', 'KINOKONOKO'];
        $sceneDescs = ['今が旬のおすすめキノコ', '全種キノコの分布MAP', 'キノコ料理レシピ集', 'キノコについて情報交換を行う場', 'キノコについて情報交換を行い愛を語り合う場'];
        for( $i = 0; $i < count($sceneNames); $i++ ){
            DB::table('scenes')->insert([
                'name' => $sceneNames[$i],
                'project_id' => $project_id,
                'description' => $sceneDescs[$i],
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }

        /**
         * タスク
         */
        $taskScenes = ['KINOKOlist', 'KINOKOlist', 'KINOKOrecipe', 'KINOKOrecipe', 'KINOKOrecipe'];
        $taskTitles = ['○○の王国××地区に生息するキノコを調査', '○○の王国□□地区に生息するキノコを調査', '○月×日 朝食「採れたてキノコのマリネ」', '○月×日 昼食「７種のキノコリゾット」', '○月×日 夕食「タコとキノコのカルパッチョ」'];
        $taskDescs = [
            '○○の王国××地区に生息する59種類のキノコの形態、構造、味、生態、その他詳細を調査する', 
            '○○の王国□□地区に生息する42種類のキノコの形態、構造、味、生態、その他詳細を調査する', 
            "「キノコのマリネ」\nレシピ提供：KINOKO is Lovers", 
            "「７種のキノコリゾット」\nレシピ提供：KINOKO is Lovers", 
            "「タコとキノコのカルパッチョ」\nレシピ提供：KINOKO is Lovers\nMEMO：Wishing DEATH of KINOKO より猛反対アリ"
        ];
        $taskStatus = ['天才', '天才', '天才', 'もうちょい', 'ｷｬﾝﾌﾟﾌｧｲﾔｰNOW'];
        for( $i = 0; $i < count($taskScenes); $i++ ){
            $scene_id = DB::table('scenes')->where('name', $taskScenes[$i])->first()->id;
            $status_id = DB::table('statuses')->where('title', $taskStatus[$i])->first()->id;
            $tomorrow = Carbon::now()->addDay(7);
            DB::table('tasks')->insert([
                'title' => $taskTitles[$i],
                'description' => $taskDescs[$i],
                'start_at' => $now,
                'end_at' => $tomorrow,
                'scene_id' => $scene_id,
                'user_id' => $user_id,
                'status_id' => $status_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }
        
    }
}
