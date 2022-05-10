<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class TeacherFactory extends Factory
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
        return [
            'first_name' => $this->faker->firstName($select),
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'gender'=> $select,
            'mobile'=> $this->faker->phoneNumber(),
            'profile_image'=> $this->faker->image(public_path('uploads/teacher/'), '100', '100', 'cats', false)
        ];
    }
}
