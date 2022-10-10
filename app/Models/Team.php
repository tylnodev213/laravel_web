<?php

namespace App\Models;

use App\Scopes\AncientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $timestamps = false;
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AncientScope);
    }
    protected $table = 'm_teams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'ins_id',
        'ins_datetime',
        'upd_id',
        'upd_datetime',
        'del_flag',
    ];

    public function employees() {
        return $this->hasMany(Employee::class,'team_id','id');
    }

}
