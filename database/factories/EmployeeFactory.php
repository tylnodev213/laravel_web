<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'team_id'=>$this->faker->numberBetween(1,10),
            'email'=>$this->faker->email,
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'gender'=>$this->faker->numberBetween(1,2),
            'birthday'=>$this->faker->date,
            'address'=>$this->faker->address,
            'avatar'=>$this->faker->image,
            'salary'=>$this->faker->numberBetween(1000,5000),
            'position'=>$this->faker->numberBetween(1,5),
            'status'=>$this->faker->numberBetween(1,2),
            'type_of_work'=>$this->faker->numberBetween(1,4),
            'ins_id'=>"1",
            'ins_datetime'=>now(),
        ];
    }
}
