<?php

use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Auth\Database\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Administrator::truncate();
        Administrator::create(
            [
                'username' => 'bangergames',
                'password' => bcrypt('!@#B4ng3R!@#'),
                'name' => 'BangerGames Admin',
            ]
        );

        // create a role.
        Role::truncate();
        Role::create(
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
            ]
        );

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert(
            [
                [
                    'name' => 'All permission',
                    'slug' => '*',
                    'http_method' => '',
                    'http_path' => '*',
                ],
                [
                    'name' => 'Dashboard',
                    'slug' => 'dashboard',
                    'http_method' => 'GET',
                    'http_path' => '/',
                ],
                [
                    'name' => 'Login',
                    'slug' => 'auth.login',
                    'http_method' => '',
                    'http_path' => "/auth/login\r\n/auth/logout",
                ],
                [
                    'name' => 'User setting',
                    'slug' => 'auth.setting',
                    'http_method' => 'GET,PUT',
                    'http_path' => '/auth/setting',
                ],
                [
                    'name' => 'Auth management',
                    'slug' => 'auth.management',
                    'http_method' => '',
                    'http_path' => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
                ],
            ]
        );

        Role::first()->permissions()->save(Permission::first());




        Artisan::call('admin:import helpers');
        Artisan::call('admin:import log-viewer');
        Artisan::call('admin:import config');
        Artisan::call('admin:import scheduling');
        Artisan::call('admin:import redis-manager');
    }
}


