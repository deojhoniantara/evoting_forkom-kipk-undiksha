<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Models\Candidate;
use App\Models\Vote;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalVoters = Voter::count();
        $totalVotes = Vote::count();
        // Get the 10 most recent votes, with voter and candidate relationships
        $recentVotes = Vote::with(['voter', 'candidate'])->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalVoters', 'totalVotes', 'recentVotes'));
    }

    public function statistics()
    {
        $candidates = \App\Models\Candidate::withCount('votes')->get();
        $totalVoters = \App\Models\Voter::count();
        $totalVotes = \App\Models\Vote::count();

        return view('admin.statistics', compact('candidates', 'totalVoters', 'totalVotes'));
    }

    public function voters()
    {
        $voters = Voter::with('vote.candidate')->get();
        return view('admin.voters', compact('voters'));
    }

    public function votes()
    {
        $votes = Vote::with(['voter', 'candidate'])->get();
        return view('admin.votes', compact('votes'));
    }
}

