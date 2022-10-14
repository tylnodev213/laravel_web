<?php

namespace App\Models;

use App\Scopes\GlobalScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new GlobalScope);
    }
    public $timestamps = false;
    protected $table = 'm_employees';
    protected $primaryKey = 'id';
    protected $position = [
        '1' => 'Manager',
        '2' => 'Team leader',
        '3' => 'BSE',
        '4' => 'Dev',
        '5' => 'Tester',
    ];
    protected $type_of_work = [
        '1' => 'Fulltime',
        '2' => 'Partime',
        '3' => 'Probationary Staff',
        '4' => 'Intern',
    ];
    protected $fillable = [
        'id',
        'team_id',
        'email',
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'address',
        'avatar',
        'salary',
        'position',
        'status',
        'type_of_work',
        'ins_id',
        'ins_datetime',
        'upd_id',
        'upd_datetime',
        'del_flag',
    ];

    public function team() {
        return $this->belongsTo(Team::class,'team_id','id')->addSelect('name');
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value),
        );
    }

    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ucfirst($attributes['first_name']) .' '. ucfirst($attributes['last_name']),
        );
    }

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => date('d/m/Y', strtotime($attributes['birthday'])),
        );
    }

    protected function getGender(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['gender'] == 1 ? 'Male' : 'Female',
        );
    }

    protected function getSalary(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => number_format($attributes['salary']) . " (VND)",
        );
    }

    protected function getPosition(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->position[$attributes['position']],
        );
    }

    protected function getTypeOfWork(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->type_of_work[$attributes['type_of_work']],
        );
    }

    protected function getStatus(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['status'] == 1 ? 'On working' : 'Retired',
        );
    }

    protected function getAvatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => config('constants.url_avatar').$attributes['avatar'],
        );
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::of($value)->after(config('constants.folder_avatar').'/')->value(),
        );
    }

}
