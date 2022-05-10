<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = array('male', 'female');
        $select = $gender[rand(0,1)];
        $teacher = rand(1,10);
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'dob' => date('Y-m-d', strtotime($this->faker->date)),
            'gender'=> $select,
            'profile_image'=> $this->faker->image(public_path('uploads/student/'), '100', '100', 'cats', false),
            'teacher_id' => $teacher
        ];
    }
}
