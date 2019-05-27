<?php

use Illuminate\Database\Seeder;

class UserSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Saul Adrian Arias',
            'email'=>'root@gmail.com',
            'password'=>Hash::make('123456'),
            'Tipo' => 'Admin'
        ]);
    }
}
