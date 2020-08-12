<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as Generator;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			'id' => Generator::uuid4()->toString(),
            'name' => 'Asd',
            'email' => 'asd@asd.asd',
            'password' => bcrypt('asdasd'),
			'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
