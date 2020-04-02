<?php

namespace App\Traits;

use App\Node;
use Carbon\Carbon;
use Hashids\Hashids;

trait SmartTrait
{
    public function bindData()
    {
        $now = Carbon::now()->toDateTimeString();
        $this->data['updated_at'] = $now;
        $this->data['code'] = 200;
    }

    public function checkNodeToken($request)
    {
        $token = $request['token'];
        $node = Node::findByToken($token)->first();
        if (!$node) {
            $this->data['status'] = 'error';
            $this->data['msg'] = 'Token Error!';
        }
        else {
            $this->node = $node;
        }
    }

    public function respond()
    {
        $this->bindData();
        $res = response($this->data, $this->data['code']);
        return $res;
    }

    public function haveAccess()
    {
        if (isset($this->data['status']) && $this->data['status'] === 'error')
            return false;
        return true;
    }
}
