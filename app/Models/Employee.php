<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'm_employees';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function teams() {
        return $this->belongsTo(Team::class,'team_id','id');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['first_name'] .' '. $attributes['last_name'],
        );
    }
}
