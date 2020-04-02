<?php

namespace App\Traits;

use App\Attendance;
use App\Device;
use App\Node;
use App\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

trait SmartTrait
{
    public function bindData()
    {
        $now = Carbon::now()->toDateTimeString();
        $this->data['updated_at'] = $now;
        $this->data['nodes'] = Device::all()->count();
        $this->data['status'] = 'Connected';
        $this->data['statusColor'] = 'success';
        $this->data['code'] = 200;
    }

    public function checkNodeToken()
    {
        if ($this->validation(['token' => 'required'])) {
            $token = $this->request['token'];
            $node = Node::findByToken($token)->first();
            if (!$node) {
                $this->data['status'] = 'error';
                $this->data['msg'] = 'Token Error!';
            } else {
                $node->update([
                    'last_check_at' => Carbon::now(),
                ]);
                $this->node = $node;
            }
        }
    }

    public function respond()
    {
        if ($this->bind)
            $this->bindData();
        if (isset($this->data['code']))
            $code = $this->data['code'];
        else
            $code = 200;
        $res = response($this->data, $code);
        return $res;
    }

    public function haveAccess()
    {
        if (isset($this->data['status']) && $this->data['status'] === 'error')
            return false;
        return true;
    }

    public function checkRequest()
    {
        $req = $this->request['request'];
        if (method_exists($this, $req)) {
            $this->{$req}();
        } else {
            $this->data['status'] = 'error';
            $this->data['msg'] = 'Request Error!';
        }
    }

    public function validation($params)
    {
        if (is_array($params) && count($params) > 0) {
            $validation = Validator::make($this->request->toArray(), $params);

            if ($validation->fails()) {
                $this->data['validations'] = $validation->errors();
                $this->data['status'] = 'error';
                $this->data['msg'] = 'Validation Error!';
            } else {
                return $this->requestData($params);
            }
        }
        return false;
    }

    public function requestData($params)
    {
        $request = array();

        foreach ($params as $key => $param) {
            $request[$key] = $this->request[$key];
        }

        if (is_array($request) && count($request) > 0)
            return $request;
        return false;
    }

    public function checkDevice()
    {
        $device = $this->validation([
            'device' => 'required|string|min:5'
        ]);
        if ($device) {
            $this->device = Device::find($device['device'])->first();
        }
    }

    public function createTask()
    {
        if ($this->device && $this->device->id > 0) {
            $task = $this->validation([
                'task' => 'required|string',
            ]);

            $rules = json_decode($this->device->key_status, true);
            $rules = $rules['rules'];

            foreach ($rules as $key => $rule) {
                if ($task['task'] === $key) {

                    foreach ($rule as $k => $pin) {

                        if ($pin['status'] == 1)
                            $taskTitle = 'Power On';
                        else
                            $taskTitle = 'Power Off';

                        if ($pin['when'] === 'now')
                            $taskWhen = Carbon::now();
                        else
                            $taskWhen = Carbon::now()->addMinutes($pin['when']);

                        Task::where('done_at', null)
                            ->where('pin_slug', $k)
                            ->update([
                                'done_at' => Carbon::now()
                            ]);

                        $data = [
                            'node_id' => $this->device->node->id,
                            'device_id' => $this->device->id,
                            'doing_at' => $taskWhen,
                            'task' => $taskTitle,
                            'status' => $pin['status'],
                            'pin_slug' => $k,
                        ];

                        Task::create($data);
                        $this->data['status'] = 'success';
                        $this->data['msg'] = 'New Task Received!';
                    }

                    $keys = json_decode($this->device->key_status, true);
                    $keys['current_rule'] = $task['task'];
                    $this->device->update(['key_status' => $keys]);
                }
            }
        }
    }

    public function masterStates()
    {
        $states = array();
        $devices = Device::all();

        foreach ($devices as $device)
        {
            $allowChange = json_decode($device->key_status, true);
            $allowChange = $allowChange['allow_change'];
            $data = [
                'title' => $device->title,
                'icon' => $device->icon,
                'hashid' => $device->idx(),
                'power' => $device->isPoweredOn(),
                'speed' => $device->isSpeedHigh(),
                'allowChange' => $allowChange
            ];
            $states[] = $data;
        }

        $this->data['devices'] = $states;
    }

    public function clientStates()
    {
        $devices = $this->node->devices;
        $pinsState = [];

        if ($devices)
        {
            foreach ($devices as $device)
            {
                $keys = json_decode($device->key_status, true);
                $keys = $keys['keys'];
                foreach ($keys as $key)
                {
                    $pinsState[$key['pin']] = $key['status'];
                }
            }
        }

        Attendance::create([
            'node_id' => $this->node->id
        ]);

        $this->data = $pinsState;
        $this->bind = false;
    }

    public function doingTask()
    {
        $task = Task::where('done_at', null)
            ->where('doing_at', '<=', Carbon::now())
            ->first();
        if ($task) {
            $device = $task->device;
            $deviceKeys = json_decode($device->key_status, true);

            $keys = $deviceKeys['keys'];

            if (isset($keys[$task->pin_slug])) {
                $keys[$task->pin_slug]['status'] = $task->status;
            }

            $deviceKeys['keys'] = $keys;


            if ($task->device->update(['key_status' => $deviceKeys])) {
                $task->update([
                    'done_at' => Carbon::now(),
                ]);
            }
            $this->data['doing'] = true;
        }
    }

    public function doings()
    {
        $this->doingTask();
        $this->doingTask();
        $this->doingTask();
        $this->doingTask();
        $this->doingTask();
    }
}
