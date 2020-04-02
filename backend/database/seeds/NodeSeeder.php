<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Programmers Room Air Conditioner',
                'token' => Str::random(32)
            ],
            [
                'title' => 'Main Hall Air Conditioner',
                'token' => Str::random(32)
            ],
            [
                'title' => 'Programmers Room Light One',
                'token' => Str::random(32)
            ],
            [
                'title' => 'Programmers Room Light Two',
                'token' => Str::random(32)
            ],
            [
                'title' => 'Automatic watering of flowers and plants',
                'token' => Str::random(32)
            ],
            [
                'title' => 'Manager',
                'token' => Str::random(32)
            ],
        ];

        foreach ($data as $datum)
        {
            \App\Node::create($datum);
        }
    }
}
