<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'm_teams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];

    public function employees() {
        return $this->hasMany(Employee::class,'team_id','id');
    }
}
