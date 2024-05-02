<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        	DB::table('users')->insert([
	        	'fname' => 'DOH',
				'lname' => 'XII ICT',
				'level' => '2',
				'email' => 'ict@ro12.doh.gov.ph',
				'password' => \Hash::make('s3cur1ty'),
                'email_verified_at' => '2023-01-01 00:00:00',
                'contactno' => '09515359406',
                'void' => true,
	        ]);
            DB::table('users')->insert([
                'fname' => 'DOH',
                'lname' => 'XII PERSONNEL',
                'level' => '2',
                'email' => 'doh12personnel@gmail.com',
                'password' => \Hash::make('s3cur1ty'),
                'email_verified_at' => '2023-01-01 00:00:00',
                'contactno' => '09515359406',
                'void' => true,
            ]);
    }
}
