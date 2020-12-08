<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_info')->delete();
        DB::table('users_info')->insert([
        	[
	        	'user_id'		=>	'1',
	        	'key'			=>	'role',
	        	'value'			=>	'1',
	        	'created_at'=>	Carbon::now(),
	        ],
	        [
	        	'user_id'		=>	'1',
	        	'key'			=>	'group',
	        	'value'			=>	'1',
	        	'created_at'=>	Carbon::now(),
	        ]
	    ]);
    }
}
