<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Yahoo Baba',     'email' => 'yahoobaba@gmail.com', 'age' => 20, 'city' => 'Delhi'],
            ['name' => 'Salman Khan',    'email' => 'salman@gmail.com',    'age' => 21, 'city' => 'Mumbai'],
            ['name' => 'Abhishek Bachan','email' => 'abhishek@gmail.com',  'age' => 18, 'city' => 'Goa'],
            ['name' => 'Shahid Kapoor',  'email' => 'shahid@gmail.com',    'age' => 17, 'city' => 'Delhi'],
            ['name' => 'Amir Khan',      'email' => 'amir@gmail.com',      'age' => 19, 'city' => 'Chennai'],
            ['name' => 'Hrithik Roshan', 'email' => 'hrithik@gmail.com',   'age' => 20, 'city' => 'Mumbai'],
            ['name' => 'Akshay Kumar',   'email' => 'akshay@gmail.com',    'age' => 21, 'city' => 'Goa'],
            ['name' => 'Varun Dhawan',   'email' => 'varun@gmail.com',     'age' => 22, 'city' => 'Delhi'],
            ['name' => 'Ranbir Kapoor',  'email' => 'ranbir@gmail.com',    'age' => 23, 'city' => 'Hyderabad'],
            ['name' => 'Kartik Aaryan',  'email' => 'kartik@gmail.com',    'age' => 24, 'city' => 'Kolkata'],
        ]);
    }
}
