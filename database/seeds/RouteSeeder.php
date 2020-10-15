<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('route')->delete();
        DB::table('route')->insert([
        	[
	        	'id'		=>	1,
	        	'name'		=>	'site_settings',
	        	'parent_id'	=>	0,
	        	'seq'		=>	1,
	        	'icon'		=>	'fa-cogs',
	        	'link'		=>	NULL,
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ],[
	        	'id'		=>	2,
	        	'name'		=>	'system_settings',
	        	'parent_id'	=>	1,
	        	'seq'		=>	0,
	        	'icon'		=>	'fa-wrench',
	        	'link'		=>	'Settings',
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ],[
	        	'id'		=>	3,
	        	'name'		=>	'dashboard',
	        	'parent_id'	=>	0,
	        	'seq'		=>	0,
	        	'icon'		=>	'fa-tachometer-alt',
	        	'link'		=>	'Dashboard',
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ],[
	        	'id'		=>	4,
	        	'name'		=>	'managers',
	        	'parent_id'	=>	0,
	        	'seq'		=>	0,
	        	'icon'		=>	'fa-users-cog',
	        	'link'		=>	'Managers',
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ]
	    ]);
    }
}
