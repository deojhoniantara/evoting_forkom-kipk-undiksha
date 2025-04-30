<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Voter;
use App\Models\Candidate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalVoters = Voter::count();
        $totalVotes = Vote::count();
        $recentVotes = Vote::with('voter')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalVoters', 'totalVotes', 'recentVotes'));
    }

    public function statistics()
    {
        $candidates = Candidate::withCount('votes')->get();
        $totalVotes = Vote::count();
        $totalVoters = Voter::count();

        return view('admin.statistics', compact('candidates', 'totalVotes', 'totalVoters'));
    }

    public function voters()
    {
        $voters = Voter::with('vote')->get();
        return view('admin.voters', compact('voters'));
    }

    public function votes()
    {
        $votes = Vote::with('voter')->latest()->get();
        return view('admin.votes', compact('votes'));
    }
}

