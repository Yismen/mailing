<?php

namespace Dainsys\Mailing\Database\Factories;

use Dainsys\Mailing\Models\Mailable;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mailable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->email(),
            'active' => $this->faker->randomElement([0, 1]),
        ];
    }

    public function active()
    {
        return $this->state(fn ($q) => [
            'active' => true
        ]);
    }

    public function inactive()
    {
        return $this->state(fn ($q) => [
            'active' => false
        ]);
    }
}
