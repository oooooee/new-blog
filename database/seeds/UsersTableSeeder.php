<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		\App\User::create([
			'username' => 'Coke-Vincent',
			'email' => 'Coke-Vincent@qq.com',
			'password' => Hash::make('h910528')
		]);

	}

}