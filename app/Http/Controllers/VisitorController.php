<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index()
    {
        // Total number of visits
        $totalVisits = Visitor::count();

        // Unique visits based on IP addresses
        $uniqueVisits = Visitor::distinct('ip_address')->count('ip_address');

        // Visits per day within the last 30 days
        $visitsPerDay = Visitor::selectRaw('DATE(visited_at) as date, COUNT(*) as visits')
            ->where('visited_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('visitors.index', compact('totalVisits', 'uniqueVisits', 'visitsPerDay'));
    }
}