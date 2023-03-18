<?php

namespace Database\Factories;

use App\Models\InvitedUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvitedUser>
 */
class InvitedUserFactory extends Factory
{
    protected $model = InvitedUser::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marketerUserId' => 1 ,
            'name' => fake()->name ,
            'family' => fake()->name ,
            'mobile' => fake()->phoneNumber,
            'nationalCode' => fake()->randomNumber(5 , true) ,
            'birthDate' => fake()->randomNumber(5 , true) ,
            'gender' => 'male' ,
            'insuranceID' => fake()->randomNumber(5 , true) ,
            'registerDate' => Carbon::now()->toDateTimeString() ,
            'status' => 'pending' ,
            'created_at' => Carbon::now()->toDateTimeString()
        ];
    }
}
