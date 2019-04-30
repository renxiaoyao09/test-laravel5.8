<?php

use Illuminate\Database\Seeder;
// use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr = [];
        for ($i=0; $i < 10; $i++) {
            $tmp = [];
            $tmp['name'] = 'admin'.($i+1);
            $tmp['email'] = 'admin'.($i+1).'@qq.com';
            $tmp['password'] = Hash::make('admin'.($i+1));
            $tmp['remember_token'] = str_random(50);
            $tmp['api_token'] = str_random(50);

            $tmp['created_at'] = date('Y-m-d H:i:s');
            $tmp['updated_at'] = date('Y-m-d H:i:s');
            $arr[] = $tmp;
        }
        DB::table('users')->insert($arr);
    }
}
