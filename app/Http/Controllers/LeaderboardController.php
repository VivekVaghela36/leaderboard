<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Leaderboard;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{

    public function index(Request $request)
    {
        $leaderboardQuery = Leaderboard::with('user');
        $currentDate = now();
        if ($request->has('filter') && $request->filter === 'day') {
            $leaderboardQuery->whereDate('created_at', $currentDate->toDateString());
        }

        if ($request->has('filter') && $request->filter === 'month') {
            $leaderboardQuery->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month);
        }
        if ($request->has('filter') && $request->filter === 'year') {
            $leaderboardQuery->whereYear('created_at', $currentDate->year);
        }
        if ($request->has('user_id') && $request->user_id != '') {
            $leaderboardQuery->where('user_id', $request->input('user_id'));
        }

        $leaderboard = $leaderboardQuery->orderBy('rank')->get();
        // dd($leaderboard);
        return view('welcome', compact('leaderboard'));
    }

    public function recalculate()
    {

        $userPoints = Activity::selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->get();


        $rank = 1;
        $previousPoints = null;

        foreach ($userPoints as $userPoint) {
            if ($userPoint->total_points !== $previousPoints) {

                $rank++;
            }
            Leaderboard::updateOrCreate(
                ['user_id' => $userPoint->user_id],
                ['total_points' => $userPoint->total_points, 'rank' => $rank++]
            );

            $previousPoints = $userPoint->total_points;
        }
        return redirect()->route('leaderboard.index')->with('success', 'Leaderboard updated successfully!');
    }
}
