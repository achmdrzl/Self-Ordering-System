<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();

        try {  
            $cashier = User::create(array_merge([
                'email' => 'cashier@gmail.com',
                'name' => 'Cashier',
            ], $default_user_value));
    
            $chef = User::create(array_merge([
                'email' => 'chef@gmail.com',
                'name' => 'Chef',
            ], $default_user_value));
    
            $manager = User::create(array_merge([
                'email' => 'manager@gmail.com',
                'name' => 'Manager',
            ], $default_user_value));
    
            $role_cashier = Role::create(['name' => 'cashier']);
            $role_chef = Role::create(['name' => 'chef']);
            $role_manager = Role::create(['name' => 'manager']);
    
            $permission = Permission::create(['name' => 'read role']);
            $permission = Permission::create(['name' => 'create role']);
            $permission = Permission::create(['name' => 'update role']);
            $permission = Permission::create(['name' => 'delete role']);
            
            $role_manager -> givePermissionTo('read role', 'create role', 'update role', 'delete role');
            $role_chef -> givePermissionTo('read role');
            $role_cashier -> givePermissionTo('read role', 'create role', 'update role');

            $cashier->assignRole('cashier');
            $chef->assignRole('chef');
            $manager->assignRole('manager');

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
