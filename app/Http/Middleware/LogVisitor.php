<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (Auth::check()) {
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            $today = Carbon::today();

            // Check if there's an existing visitor record for this IP and user agent today
            $existingVisit = Visitor::where('ip_address', $ipAddress)
                ->where('user_agent', $userAgent)
                ->whereDate('visited_at', $today)
                ->first();

            // If no existing visit record, create a new one
            if (!$existingVisit) {
                Visitor::create([
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'referrer' => $request->headers->get('referer'),
                    // 'page_url' => $request->fullUrl(), // Include the full URL of the request
                ]);
            }
        }

        return $next($request);
    }
}
