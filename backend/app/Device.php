<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;
    use ModelTrait;
    protected $table = 'devices';
    protected $fillable = [
        'node_id',
        'title',
        'number_of_keys',
        'key_status',
    ];

    public function node()
    {
        return $this->belongsTo('App\Node');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function isPoweredOn()
    {
        $keys = json_decode($this->key_status, true);
        if ($keys['current_rule'] == 'power-on' || $keys['current_rule'] == 'speed-high' ||  $keys['current_rule'] == 'speed-low')
            return true;
        return false;
    }

    public function isPoweredOff()
    {
        $keys = json_decode($this->key_status, true);
        if ($keys['current_rule'] == 'power-off')
            return true;
        return false;
    }

    public function isSpeedHigh()
    {
        $keys = json_decode($this->key_status, true);
        if ($keys['current_rule'] == 'speed-high')
            return true;
        return false;
    }

    public function isSpeedLow()
    {
        $keys = json_decode($this->key_status, true);
        if ($keys['current_rule'] == 'speed_low')
            return true;
        return false;
    }

}
