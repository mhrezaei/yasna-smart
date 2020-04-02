<?php namespace App;

use Hashids\Hashids;

trait ModelTrait
{
    public function find($id)
    {
        if (is_numeric($id))
        {
            return self::where('id', $id);
        }
        elseif (is_string($id))
        {
            $hashids = new Hashids();
            $id = $hashids->decode($id);
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
        $hashids = new Hashids('', 5);
        $id = $hashids->encode($this->id);
        return $id;
    }
}
