<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function index()
    {
        // Stats for the dashboard
        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::whereDate('created_at', now()->today())->count();

        // Group by IP to see unique visitors per day (estimated)
        $uniqueVisitors = Visitor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(DISTINCT ip_address) as count'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(30)
            ->get();

        $latestVisitors = Visitor::latest()->take(50)->get();

        return view('admin.visitors.index', compact(
            'totalVisitors',
            'todayVisitors',
            'uniqueVisitors',
            'latestVisitors'
        ));
    }
}
