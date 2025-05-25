<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

trait HandleError
{
    /**
     * Handle errors and exceptions in a consistent way.
     *
     * @param callable $callback
     * @return mixed
     */
    public function handleError(callable $callback)
    {
        try {
            return $callback();
        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return null; // or handle the error as needed
        }
    }
}
