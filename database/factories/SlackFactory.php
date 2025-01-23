<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Slack;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slack>
 */
class SlackFactory extends Factory
{
    protected $model = Slack::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'slack_id' => $this->faker->regexify('[A-Z][0-9]{10}'),
            'slack_text' => $this->faker->text(200),
            'slack_ts' => $this->faker->dateTimeBetween('-1 year', 'now')->getTimestamp()
        ];
    }
}
