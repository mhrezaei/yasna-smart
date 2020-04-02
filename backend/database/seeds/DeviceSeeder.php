<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nodes = \App\Node::all();
        foreach ($nodes as $node)
        {
            if ($node->title != "Manager")
            {
                $pinA = Str::random(6);
                $pinB = Str::random(6);
                $pinC = Str::random(6);
                $x = [
                    'keys' => [
                        $pinA => [
                            'title' => 'Pomp Power',
                            'pin' => '13',
                            'type' => 'output',
                            'status' => '0',
                            'allow_change' => true,
                        ],
                        $pinB => [
                            'title' => 'Low Motor Power',
                            'pin' => '14',
                            'type' => 'output',
                            'status' => '0',
                            'allow_change' => true,
                        ],
                        $pinC => [
                            'title' => 'High Motor Power',
                            'pin' => '15',
                            'type' => 'output',
                            'status' => '0',
                            'allow_change' => true,
                        ],
                    ],
                    'rules' => [
                        'power-on' => [
                            $pinA => [
                                'status' => '1',
                                'when' => 'now',
                            ],
                            $pinB => [
                                'status' => '1',
                                'when' => 10,
                            ],
                            $pinC => [
                                'status' => '0',
                                'when' => 'now'
                            ],
                        ],
                        'power-off' => [
                            $pinA => [
                                'status' => '0',
                                'when' => 'now',
                            ],
                            $pinB => [
                                'status' => '0',
                                'when' => 'now',
                            ],
                            $pinC => [
                                'status' => '0',
                                'when' => 'now'
                            ],
                        ],
                        'speed-high' => [
                            $pinA => [
                                'status' => '1',
                                'when' => 'now',
                            ],
                            $pinB => [
                                'status' => '0',
                                'when' => 'now',
                            ],
                            $pinC => [
                                'status' => '1',
                                'when' => 'now'
                            ],
                        ],
                        'speed-low' => [
                            $pinA => [
                                'status' => '1',
                                'when' => 'now',
                            ],
                            $pinB => [
                                'status' => '1',
                                'when' => 'now',
                            ],
                            $pinC => [
                                'status' => '0',
                                'when' => 'now'
                            ],
                        ],
                    ],
                    'current_rule' => false,
                    'allow_change' => true,
                ];

                $data = [
                    'node_id' => $node->id,
                    'title' => $node->title,
                    'icon' => 'ni-ui-04',
                    'key_status' => json_encode($x),
                ];
                \App\Device::create($data);
            }
        }
    }
}
