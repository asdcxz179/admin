<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
        	[
	        	'username'	=>	'system_admin',
	        	'name'		=>	'system_admin',
	        	'email'		=>	'admin@system.mail',
	        	'password'	=>	'$2y$10$p1C3Up64ojrbmRifKW/a/e6rQ4UtO9Hg.eP9XcvkDGxDkxRzoJoU.',
	        	'created_at'=>	Carbon::now(),
	        ]
	    ]);
    }
}
