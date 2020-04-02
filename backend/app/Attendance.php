<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    use ModelTrait;
    protected $table = 'attendances';
    protected $fillable = [
        'node_id',
    ];

    public function node()
    {
        return $this->belongsTo('App\Node');
    }
}
