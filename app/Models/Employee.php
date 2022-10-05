<?php

namespace App\Models;

use App\Scopes\AncientScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
    }
    public $timestamps = false;
    protected $table = 'm_employees';
    protected $primaryKey = 'id';
    protected $fillable = [
        'team_id',
        'email',
        'first_name',
        'last_name',
        'password',
        'gender',
        'birthday',
        'address',
        'avatar',
        'salary',
        'position',
        'status',
        'type_of_word',
        'ins_id',
        'ins_datetime',
        'upd_id',
        'upd_datetime',
        'del_flag',
    ];

    public function teams() {
        return $this->belongsTo(Team::class,'team_id','id');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['first_name'] .' '. $attributes['last_name'],
        );
    }

    protected function teamName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['team_name'],
        );
    }

    protected static function booted()
    {
        static::addGlobalScope(new AncientScope);
    }
}
