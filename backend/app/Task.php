<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    use ModelTrait;
    protected $table = 'tasks';
    protected $fillable = [
        'node_id',
        'device_id',
        'task',
        'status',
        'doing_at',
        'done_at',
    ];

    public function device()
    {
        return $this->hasOne('App\Device');
    }

    public function node()
    {
        return $this->hasOne('App\Node');
    }

}
