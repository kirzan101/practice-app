<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'home1',
                'description' => 'description'
            ],
            [
                'name' => 'home2',
                'description' => 'description2'
            ]
        ];

        foreach ($datas as $data) {
            Home::create($data);
        }
    }
}
