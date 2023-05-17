<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->registerUser();
        $this->registerPost();
        $this->registerReference();
    }

    public function registerUser()
    {
        $datas = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'ref_role_id' => 10,
            ],
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'ref_role_id' => 8,
            ],
            [
                'name' => 'Expert',
                'email' => 'expert@example.com',
                'password' => bcrypt('password'),
                'ref_role_id' => 9,
            ],
        ];

        foreach ($datas as $data) {
            DB::table('users')->insert($data);
        }
    }

    public function registerPost()
    {
        $datas = [
            [
                'user_id' => 2,
                'ref_category_id' => 1,
                'title' => 'Post 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                    enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.',
                'accepted_by' => 3,
                'answer' => 'Duis aute irure dolor in reprehenderit
                    in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.',
                'ref_post_status_id' => 1,
                'created_at' => '2023-05-16 15:23:54.000'
            ],
            [
                'user_id' => 2,
                'ref_category_id' => 1,
                'title' => 'Post 2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                    enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                    in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.',
                'ref_post_status_id' => 1,
                'created_at' => '2023-05-16 15:24:54.000'
            ],
        ];

        foreach ($datas as $data) {
            DB::table('posts')->insert($data);
        }
    }

    public function registerReference()
    {
        $datas = [
            //category
            [
                'name' => 'category',
                'code' => 1,
                'value' => 'Database',
            ],
            [
                'name' => 'category',
                'code' => 2,
                'value' => 'Networking',
            ],
            [
                'name' => 'category',
                'code' => 3,
                'value' => 'Web Engineering',
            ],
            //post-status
            [
                'name' => 'post-status',
                'code' => 1,
                'value' => 'New',
            ],
            [
                'name' => 'post-status',
                'code' => 2,
                'value' => 'Accepted',
            ],
            [
                'name' => 'post-status',
                'code' => 3,
                'value' => 'Revised',
            ],
            [
                'name' => 'post-status',
                'code' => 4,
                'value' => 'Completed',
            ],
            //roles
            [
                'name' => 'roles',
                'code' => 1,
                'value' => 'user',
            ],
            [
                'name' => 'roles',
                'code' => 2,
                'value' => 'expert',
            ],
            [
                'name' => 'roles',
                'code' => 3,
                'value' => 'admin',
            ],
        ];

        foreach ($datas as $data) {
            DB::table('references')->insert($data);
        }
    }
}
