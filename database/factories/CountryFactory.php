<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use libphonenumber\PhoneNumberUtil;

class CountryFactory extends Factory
{
    protected $model = Country::class;
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->countryCode(),
            'phone_code' => fake()->unique()->phoneNumber(),
        ];
    }
}
