<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Base extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Арман Кожанов',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Айман Ботагозова',
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ]
            ];
        DB::table('users')->insert($users);

        $statuses = [
            [
                'name' => 'Новая',
            ],
            [
                'name' => 'Выполняется',
            ],
            [
                'name' => 'Выполнен',
            ],
            [
                'name' => 'Ожидается',
            ]
            ];

        DB::table('task_statuses')->insert($statuses);

        $tasks = [
            [
                'name' => 'Задача 1',
                'status_id' => 1,
                'user_id' => 1,
                'developer_id' => 2,
                'deadline_time' => Carbon::now()->addDay(rand(1,9))
            ],
            [
                'name' => 'Задача 2',
                'status_id' => 2,
                'user_id' => 1,
                'developer_id' => 2,
                'deadline_time' => Carbon::now()->addDay(rand(1, 9))
            ],
            [
                'name' => 'Задача 3',
                'status_id' => 3,
                'user_id' => 1,
                'developer_id' => 2,
                'deadline_time' => Carbon::now()->addDay(rand(1, 9))
            ]
        ];

        DB::table('tasks')->insert($tasks);
    }
}
