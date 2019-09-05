<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate(); //清空資料庫
        \App\User::create([
            'username' => 'chcg',
            'name' => '系統管理員',
            'group_id' => '9',
            'password' => bcrypt('7222151'),
            'admin'=>'1',
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        \App\User::create([
            'username' => 'test1',
            'name' => '測試國小組長',
            'group_id' => '1',
            'password' => bcrypt('demo1234'),
            'code'=>'074799',
            'school'=>'測試國小',
            'kind'=>'教職員',
            'title'=>'教學組長',
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        \App\User::create([
            'username' => 'test2',
            'name' => '測試國中組長',
            'group_id' => '2',
            'password' => bcrypt('demo1234'),
            'code'=>'074599',
            'school'=>'測試國中',
            'kind'=>'教職員',
            'title'=>'教學組長',
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        \App\User::create([
            'username' => 'special1',
            'name' => '特教委員1',
            'group_id' => '3',
            'password' => bcrypt('demo1234'),
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        \App\User::create([
            'username' => 'special2',
            'name' => '特教委員2',
            'group_id' => '3',
            'password' => bcrypt('demo1234'),
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        \App\User::create([
            'username' => 'first1',
            'name' => '初審委員1',
            'group_id' => '4',
            'password' => bcrypt('demo1234'),
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        \App\User::create([
            'username' => 'first2',
            'name' => '初審委員2',
            'group_id' => '4',
            'password' => bcrypt('demo1234'),
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        \App\User::create([
            'username' => 'second1',
            'name' => '複審委員1',
            'group_id' => '5',
            'password' => bcrypt('demo1234'),
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        \App\User::create([
            'username' => 'second2',
            'name' => '複審委員2',
            'group_id' => '5',
            'password' => bcrypt('demo1234'),
            'login_type'=>'local',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
