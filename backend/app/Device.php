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
        return $this->hasOne('App\Node');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

}
