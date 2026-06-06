<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'gender'     => $this->faker->randomElement([1, 2]),
            'email'      => $this->faker->safeEmail(),
            'tel'        => $this->faker->phoneNumber(),
            'address'    => $this->faker->address(),
            'building'   => $this->faker->secondaryAddress(),
            'category_id'=> 1,
            'detail'     => $this->faker->realText(50),
        ];
    }
}
