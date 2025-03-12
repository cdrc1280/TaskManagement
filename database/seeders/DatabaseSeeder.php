<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\PermissionsEnum;
use App\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $commenterRole = Role::create(['name' => RolesEnum::Commenter->value]);
        $adminRole = Role::create(['name' => RolesEnum::Admin->value]);


        $manageFeaturesPermission = Permission::create([
            'name' => PermissionsEnum::ManageFeatures->value,
        ]);
        $manageUsersPermission = Permission::create([
            'name' => PermissionsEnum::ManageUsers->value,
        ]);
        $manageCommentsPermission = Permission::create([
            'name' => PermissionsEnum::ManageComments->value,
        ]);
        $upvoteDownVotesPermission = Permission::create([
            'name' => PermissionsEnum::UpvoteDownVotes->value,
        ]);


        $userRole->syncPermissions([$upvoteDownVotesPermission]);
        $commenterRole->syncPermissions([
            $upvoteDownVotesPermission,
            $manageCommentsPermission
        ]);
        $adminRole->syncPermissions([
            $manageFeaturesPermission,
            $manageUsersPermission,
            $manageCommentsPermission,
            $upvoteDownVotesPermission
        ]);


        User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
        ])->assignRole(RolesEnum::User);

        User::factory()->create([
            'name' => 'commenter',
            'email' => 'commenter@gmail.com',
        ])->assignRole(RolesEnum::Commenter);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ])->assignRole(RolesEnum::Admin);

        Feature::factory(100)->create();

    }
}
