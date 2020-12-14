<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class TestTableSeeder extends Seeder
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
         * ユーザ
         */
        DB::table('users')->insert([
            'name' => 'hoge',
            'email' => 'hoge@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * プロジェクト
         */
        DB::table('projects')->insert([
            'name' => 'TestProjectTitle',
            'description' => 'TestProjectDescription',
            'using' => 'TestProjectUsing',
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * メンバ
         */
        $project_id = DB::table('projects')->where('name', 'TestProjectTitle')->first()->id;
        $user_id = DB::table('users')->where('name', 'hoge')->first()->id;
        $role_id = DB::table('roles')->where('name', '代表')->first()->id;
        DB::table('members')->insert([
            'project_id' => $project_id,
            'user_id' => $user_id,
            'role_id' => $role_id,
            'is_join' => 1,
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * シーン
         */
        DB::table('scenes')->insert([
            'name' => 'TestSceneName',
            'project_id' => $project_id,
            'description' => 'TestSceneDiscription',
            'is_first' => true,
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * タスク
         */
        $scene_id = DB::table('scenes')->where('name', 'TestSceneName')->first()->id;
        $status_id = DB::table('statuses')->where('title', 'はやくやれ')->first()->id;
        $tomorrow = Carbon::now()->addDay(7);
        DB::table('tasks')->insert([
            'title' => 'TestTaskTitle',
            'description' => 'TestTaskDiscription',
            'start_at' => $now,
            'end_at' => $tomorrow,
            'scene_id' => $scene_id,
            'user_id' => $user_id,
            'status_id' => $status_id,
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * デコレーション
         */
        $element_id = DB::table('elements')->where('name', 'Button')->first()->id;
        DB::table('decorations')->insert([
            'text' => 'TestDecorationText',
            'description' => 'TestDecorationDiscription',
            'font_size' => 30,
            'width' => 300,
            'height' => 100,
            'position_x' => 100,
            'position_y' => 100,
            'scene_id' => $scene_id,
            'is_auto_size' => false,
            'font_color' => '#ff6347',
            'element_id' => $element_id,
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * デコレーション - タスク
         */
        $task_id = DB::table('tasks')->where('title', 'TestTaskTitle')->first()->id;
        $decoration_id = DB::table('decorations')->where('text', 'TestDecorationText')->first()->id;
        DB::table('decorations_tasks')->insert([
            'task_id' => $task_id,
            'decoration_id' => $decoration_id,
            'created_at' => $now, 
            'updated_at' => $now,
        ]);

        /**
         * ログ
         */
        $logTexts = [
            'ユーザ「hoge」作成', 
            'ユーザ「hoge」がプロジェクト「TestProjectTitle」を作成', 
            'ユーザ「hoge」が画面「TestSceneName」を作成', 
            'ユーザ「hoge」がタスク「TestTaskTitle」を作成', 
            'ユーザ「hoge」がデザイン「TestDecorationText」を更新'
        ];
        $logCategories = ['create', 'create', 'create', 'create', 'update'];
        $logProjects = [null, 'TestProjectTitle', 'TestProjectTitle', 'TestProjectTitle', 'TestProjectTitle'];
        for( $i = 0; $i < count($logTexts); $i++ ){
            $category_id = DB::table('log_categories')->where('content', $logCategories[$i])->first()->id;
            $logProject_id = is_null($logProjects[$i]) ? null : DB::table('projects')->where('name', $logProjects[$i])->first()->id;
            DB::table('logs')->insert([
                'text' => $logTexts[$i],
                'user_id' => $user_id,
                'log_category_id' => $category_id,
                'project_id' => $logProject_id,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }

    }
}
