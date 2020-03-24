<?php

require './jdf.php';

userAccept();

function post($parameters)
{
    $post = array();
    if(is_array($parameters) && count($parameters) > 0)
    {
        for($i = 0; $i < count($parameters); $i++)
        {
            if(isset($_POST[$parameters[$i]]) && strlen($_POST[$parameters[$i]]) > 0)
            {
                $param = $_POST[$parameters[$i]];
                $param = trim(htmlspecialchars($param));
                $post[$parameters[$i]] = $param;
            }
            else
            {
                $post[$parameters[$i]] = false;
            }

            if(count($parameters) == 1)
            {
                $post = $post[$parameters[$i]];
            }
        }
    }
    else
    {
        return false;
    }
    return $post;
}

function checkToken()
{
    $token = post(['token']);
    if(!is_string($token))
    {
        die('Token Error');
    }
}

function checkMethod()
{
    $_SERVER['REQUEST_METHOD'] === 'POST' ? $method = 'POST' : die('Method Error');
}

function userAccept()
{
    checkMethod();
    checkToken();
    checkRequest();
}

function getStates()
{
    $states = file_get_contents('States.json');
    $states = json_decode($states, true);
    return bindStates($states);

    return [
        'cooling1' => [
            'power' => 'off',
            'speed' => 'high',
            'error' => 'no',
        ],
        'cooling2' => [
            'power' => 'on',
            'speed' => 'low',
            'error' => 'yes',
        ],
        'light1' => [
            'power' => 'on',
            'lumen' => 'high',
            'error' => 'no',
        ],
        'light2' => [
            'power' => 'off',
            'lumen' => 'low',
            'error' => 'yes',
        ],
        'light3' => [
            'power' => 'on',
            'lumen' => 'LOW',
            'error' => 'no',
        ],
        'water' => [
            'power' => 'on',
            'error' => 'no',
        ],
    ];
}

function putStates($parameters)
{
    if(file_put_contents('States.json', json_encode(unbindStates($parameters))))
    {
        return true;
    }
    else{
        return false;
    }
}

function checkRequest()
{
    $func = post(['request']);
    $func = "request" . $func;
    if(function_exists("$func"))
    {
        return $func();
    }
    else
    {
        die('Request Error');
    }
}

function bindStates($states)
{
    $states['time'] = jdate('l d F - H:i:s', time());
    return $states;
}

function unbindStates($states)
{
    unset($states['time']);
    return $states;
}

function response($status, $parameters)
{
    $pm['status'] = $status;
    print_r($parameters);
    $pm = compact($pm, $parameters);
    echo json_encode($pm);
}

function requestGetStates()
{
    response(200, getStates());
}

function requestSaveSample(){
    $task = post(['task']);
    $data = [
        'task' => $task,
    ];

    $r = DB::insert('tasks', $data);

    response(200, $r);
}