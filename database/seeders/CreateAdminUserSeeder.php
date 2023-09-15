<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Super Admin Seeder
        $user = User::create([
            'first_name' => mb_strtoupper('Admin'), 
            'last_middle_name' => mb_strtoupper('Super'), 
            'email' => 'superadmin@school.com',
            'password' => bcrypt('123123123')
        ]);
      
        $role = Role::create(['name' => 'Super Admin']);
       
        $permissions = Permission::pluck('id','id')->all();
     
        $role->syncPermissions($permissions);
       
        $user->assignRole([$role->id]);
    }
}