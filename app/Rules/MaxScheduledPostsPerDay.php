<?php

namespace App\Rules;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

class MaxScheduledPostsPerDay implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Get the current date
        $dayTime = Carbon::parse($value);

        $startOfDay = $dayTime->copy()->startOfDay();
        $endOfDay = $dayTime->copy()->endOfDay();


        // Count the number of scheduled posts for the current date
        $scheduledPostsCount = Post::whereBetween('scheduled_time', [$startOfDay, $endOfDay])
            ->where('status', 'scheduled')
            ->count();

        // Check if the count exceeds the limit
        if ($scheduledPostsCount >= 5) {
            $fail('You can only schedule a maximum of 5 posts per day.');
        }
    }
}
