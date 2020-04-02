<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Node extends Model
{
    use SoftDeletes;
    use ModelTrait;
    protected $table = 'nodes';
    protected $fillable = [
        'title',
        'token',
        'last_check_at'
    ];

    public function devices()
    {
        return $this->hasMany('App\Device');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }

    public static function findByToken($token)
    {
        return self::where('token', $token);
    }

}
