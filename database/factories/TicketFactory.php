<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $assets=['mobile','laptop','tablet'];
        $priority=['low','medium','high','emergency'];
        $assigned_to=[9,10];  //we have two agents now
        $status=['pending','approved','ready_to_dispatch','dispatched','closed'];

        return [
            'name' => $this->faker->name(),
            'phone'=>$this->faker->phoneNumber,
            'assets'=>Arr::random($assets),
            'priority'=>Arr::random($priority),
            'serial_no'=>$this->faker->numberBetween(10001,50001),
            'model_no'=>$this->faker->numberBetween(10001,50001),
            'assigned_to'=>Arr::random($assigned_to),
            'status'=> Arr::random($status),
        ];
    }
}
