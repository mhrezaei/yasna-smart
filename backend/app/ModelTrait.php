<?php namespace App;

use Hashids\Hashids;

trait ModelTrait
{
    public static function find($id)
    {
        if (is_numeric($id))
        {
            return self::where('id', $id);
        }
        elseif (is_string($id))
        {
            $id = self::hashid($id);
            if (is_numeric($id))
            {
                return self::where('id', $id);
            }
            else
            {
                return new self();
            }
        }
        return new self();
    }

    public function idx()
    {
        return self::hashid($this->id);
    }

    public static function hashid($idx)
    {
        $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $hashid =  new Hashids($salt, 5);
        $result = false;

        if (is_numeric($idx))
        {
            $result = $hashid->encode($idx);
        }
        elseif (is_string($idx))
        {
            $result = $hashid->decode($idx)[0];
        }
        return $result;
    }
}
