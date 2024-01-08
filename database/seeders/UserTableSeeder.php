<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->Insert([
            [
                'nom'=>'toure',
                'prenom'=>'rokhaya',
                'name'=>'rokhaya',
                'email'=> 'rokhaya@gmail.com',
                'password'=> Hash::make('1111'),
                'role'=>'admin',
                'status'=>'active'
                
            ],

            [
                'nom'=>'basse',
                'prenom'=>'moussa',
                'name'=>'moussa',
                'email'=> 'moussa@gmail.com',
                'password'=> Hash::make('1111'),
                'role'=>'user',
                'status'=>'active'
                
            ],
            [
                'nom'=>'boura',
                'prenom'=>'ngom',
                'name'=>'boura',
                'email'=> 'boura@gmail.com',
                'password'=> Hash::make('1111'),
                'role'=>'agence',
                'status'=>'active'
                
            ],


        ]);
    }
}
