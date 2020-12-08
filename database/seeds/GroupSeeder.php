<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group')->delete();
        DB::table('group')->insert([
        	[
	        	'name'		=>	'最高權限',
	        	'created_at'=>	Carbon::now(),
	        ]
	    ]);
    }
}
