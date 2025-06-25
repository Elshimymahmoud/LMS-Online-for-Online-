<?php

namespace App\Http\Middleware;

use Closure;
use GeoIP;
use Illuminate\Support\Facades\Log;

class DetectTimezone
{
    public function handle($request, Closure $next)
    {

        // Check if the user is authenticated
        if (auth()->check()) {
            $user = auth()->user();

            // Check if the user does not have a timezone saved
            if (!$user->timezone) {

                // Get the IP address of the user
                $ip = $request->ip();

                // Get the location and timezone from the IP address
                $location = GeoIP::getLocation($ip);
                $timezone = $location->timezone;

                // Save the timezone to the user
                $user->timezone = $timezone;
                $user->save();
            }
        }

        // Proceed to the next middleware
        return $next($request);
    }
}