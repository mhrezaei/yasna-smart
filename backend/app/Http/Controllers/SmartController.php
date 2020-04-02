<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Device;
use App\Traits\SmartTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SmartController extends Controller
{
    use SmartTrait;
    protected $request;
    protected $data;
    protected $node;
    protected $device;
    protected $bind = true;

    public function index(Request $request)
    {
        $this->request = $request;
        $this->doings();
        $this->checkNodeToken();
        if ($this->haveAccess())
            $this->checkRequest();
        return $this->respond();
    }

    private function getStates()
    {
        $this->masterStates();
    }

    private function newTask()
    {
        $this->checkDevice();
        $this->createTask();
    }

    public function getClientStates()
    {
        $this->clientStates();
    }
}
