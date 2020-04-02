<?php

namespace App\Http\Controllers;

use App\Node;
use App\Traits\SmartTrait;
use Illuminate\Http\Request;

class SmartController extends Controller
{
    use SmartTrait;
    protected $request;
    protected $data;
    protected $node;

    public function cons($request)
    {
        $this->request = $request;
        $this->checkNodeToken($this->request);
    }

    public function getStates(Request $request)
    {
        $this->cons($request);
        if ($this->haveAccess()) {
            $this->data['data'] = $this->node->idx();

        }
        return $this->respond();
    }
}
