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
			'id' => 'eca1ca75-9e80-493f-bfef-cbeb44f8aac3',
            'name' => 'Asd',
            'email' => 'asd@asd.asd',
            'password' => bcrypt('asdasd'),
			'email_verified_at' => date('Y-m-d H:i:s'),
			'picture_url' => 'storage/images/gravatar/pp1.jpg',
        ]);
    }
}
