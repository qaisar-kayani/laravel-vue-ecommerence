<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('admin')->insert([
            'first_name' =>"Aamir",
            'last_name'=>"Bashir",
            'email' =>'aamir@iskaan.com',
            'status'=>1,
            'status'=>1,
            'password' => Hash::make('123456'),
        ]);
    
    }
}
