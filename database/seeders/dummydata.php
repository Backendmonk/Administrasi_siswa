<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dummydata extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=>'Wayan',
                'email'=>'wayanAdmin@gmail.com',
                'role'=>'Admin',
                'password'=>bcrypt('123456')
            ],

            [
                'name'=>'Gede',
                'email'=>'gedeGuru@gmail.com',
                'role'=>'Guru',
                'password'=>bcrypt('123456')
                
            ],
            
            [
                'name'=>'ketut',
                'email'=>'ketutMurid@gmail.com',
                'role'=>'Murid',
                'password'=>bcrypt('123456')
                
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
