<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $roles = ['管理者', '代表', '一般'];

        foreach( $roles as $role ){
            DB::table('roles')->insert([
                'name' => $role,
                'created_at' => $now, 
                'updated_at' => $now,
            ]);
        }

    }
}
