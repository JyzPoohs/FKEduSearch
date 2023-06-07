<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


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
        $this->registerComplaint();
        $this->registerReference();
        User::factory()->count(20)->create();
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
                'name' => 'User 1',
                'email' => 'user.1@example.com',
                'password' => bcrypt('password'),
                'ref_role_id' => 8,
            ],
            [
                'name' => 'User 2',
                'email' => 'user.2@example.com',
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
                'accepted_by' => 4,
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
                'accepted_by' => 7,
                'ref_post_status_id' => 1,
                'created_at' => '2023-05-16 15:24:54.000'
            ],
            [
                'user_id' => 20,
                'ref_category_id' => 2,
                'title' => 'Post 3',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                    enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea.',
                'accepted_by' => 18,
                'answer' => 'Duis aute irure dolor in reprehenderit
                    in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.',
                'ref_post_status_id' => 4,
                'created_at' => '2023-06-06 15:24:54.000'
            ],
        ];

        foreach ($datas as $data) {
            DB::table('posts')->insert($data);
        }
    }

    public function registerComplaint()
    {
        $datas = [
            [
                'user_id' => 2,
                'post_id' => 2,
                'ref_complaint_type_id' => 11,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.',
                'ref_complaint_status_id' => 15,
                'created_at' => '2023-05-16 15:23:54.000'
            ],
            [
                'user_id' => 2,
                'post_id' => 1,
                'ref_complaint_type_id' => 12,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                'ref_complaint_status_id' => 16,
                'created_at' => '2023-05-17 15:23:54.000'
            ],
            [
                'user_id' => 20,
                'post_id' => 3,
                'ref_complaint_type_id' => 13,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'ref_complaint_status_id' => 14,
                'created_at' => '2023-05-18 18:33:14.000'
            ],
        ];

        foreach ($datas as $data) {
            DB::table('complaints')->insert($data);
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
                'code' => 8,
                'value' => 'user',
            ],
            [
                'name' => 'roles',
                'code' => 9,
                'value' => 'expert',
            ],
            [
                'name' => 'roles',
                'code' => 10,
                'value' => 'admin',
            ],
            //complaint-type
            [
                'name' => 'complaint-type',
                'code' => 1,
                'value' => 'Unsatisfied Expert Feedback',
            ],
            [
                'name' => 'complaint-type',
                'code' => 2,
                'value' => 'Wrongly Assigned Research Area',
            ],
            [
                'name' => 'complaint-type',
                'code' => 3,
                'value' => 'Inapproriate Feedback',
            ],
            //complaint-status
            [
                'name' => 'complaint-status',
                'code' => 1,
                'value' => 'In Investigation',
            ],
            [
                'name' => 'complaint-status',
                'code' => 2,
                'value' => 'On Hold',
            ],
            [
                'name' => 'complaint-status',
                'code' => 3,
                'value' => 'Resolved',
            ],
        ];

        foreach ($datas as $data) {
            DB::table('references')->insert($data);
        }
    }
}
