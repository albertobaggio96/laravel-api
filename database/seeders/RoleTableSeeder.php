<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'value' => '1'
            ],
            [
                'name' => 'semiAdmin',
                'value' => '2'
            ],
            [
                'name' => 'Moderator',
                'value' => '3'
            ],
            [
                'name' => 'User',
                'value' => '4'
            ],
            
        ];

        foreach($roles as $role){
            $newRole = new Role();
            $newRole->name = $role['name'];
            $newRole->permission_value = $role['value'];
            $newRole->save();
        }
    }
}
