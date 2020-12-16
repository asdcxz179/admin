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
	        	'parent_id'	=>	7,
	        	'seq'		=>	0,
	        	'icon'		=>	'fa-users-cog',
	        	'link'		=>	'Managers',
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ],[
	        	'id'		=>	5,
	        	'name'		=>	'manager_group',
	        	'parent_id'	=>	7,
	        	'seq'		=>	0,
	        	'icon'		=>	'fa-user-friends',
	        	'link'		=>	'ManagerGroup',
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ],[
	        	'id'		=>	6,
	        	'name'		=>	'manager_role',
	        	'parent_id'	=>	7,
	        	'seq'		=>	0,
	        	'icon'		=>	'fa-user-tag',
	        	'link'		=>	'ManagerRole',
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ],[
	        	'id'		=>	7,
	        	'name'		=>	'system_manager',
	        	'parent_id'	=>	0,
	        	'seq'		=>	2,
	        	'icon'		=>	'fa-server',
	        	'link'		=>	NULL,
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ],[
	        	'id'		=>	8,
	        	'name'		=>	'disable_manager',
	        	'parent_id'	=>	4,
	        	'seq'		=>	0,
	        	'icon'		=>	'fa-ban',
	        	'link'		=>	'DisableManager',
	        	'status'	=>	1,
	        	'created_at'=>	Carbon::now(),
	        ]
	    ]);
    }
}
