<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->delete();
        DB::table('role')->insert([
        	[
	        	'name'		=>	'管理員',
	        	'created_at'=>	Carbon::now(),
	        ]
	    ]);
    }
}
