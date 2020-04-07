<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_roles')->truncate();
        
        \DB::table('user_roles')->insert([
           'name'=>'Administrator' 
        ]);
        \DB::table('user_roles')->insert([
           'name'=>'Editor' 
        ]);
        \DB::table('user_roles')->insert([
           'name'=>'Writer' 
        ]);
    }
}
