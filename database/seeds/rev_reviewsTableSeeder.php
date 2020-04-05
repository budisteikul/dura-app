<?php

use Illuminate\Database\Seeder;

class rev_reviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('rev_resellers')->insert([
			'id' => 'd2ae97f9-6da6-11e8-a513-0a2ad9ec68ab',
            'name' => 'Viator.com',
			'status' => 1,
        ]);
    }
}
