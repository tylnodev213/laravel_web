<?php

namespace App\Models;

use App\Enums\Employee\GenderEnum;
use App\Enums\Employee\PositionEnum;
use App\Enums\Employee\StatusEnum;
use App\Enums\Employee\TypeOfWorkEnum;
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
            get: fn ($value, $attributes) => GenderEnum::getKey((int)$attributes['gender']),
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
            get: fn ($value, $attributes) => PositionEnum::getKey((int)$attributes['position']),
        );
    }

    protected function getTypeOfWork(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => TypeOfWorkEnum::getKey((int)$attributes['type_of_work']),
        );
    }

    protected function getStatus(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => StatusEnum::getKey((int)$attributes['status']),
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
