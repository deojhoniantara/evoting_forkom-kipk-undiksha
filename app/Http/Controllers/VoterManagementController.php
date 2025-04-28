<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VoterManagementController extends Controller
{
    public function index()
    {
        $voters = Voter::all();
        return view('admin.voter-management.index', compact('voters'));
    }

    public function create()
    {
        return view('admin.voter-management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|unique:voters,identifier',
        ]);

        // Generate unique voting code
        do {
            $votingCode = strtoupper(Str::random(6)); // Generate 6 character code
        } while (Voter::where('voting_code', $votingCode)->exists());

        Voter::create([
            'name' => $request->name,
            'identifier' => $request->identifier,
            'voting_code' => $votingCode,
        ]);

        return redirect()->route('voter-management.index')
            ->with('success', 'Pemilih berhasil ditambahkan dengan kode voting: ' . $votingCode);
    }

    public function export()
    {
        $voters = Voter::all();
        return view('admin.voter-management.export', compact('voters'));
    }

    public function destroy($id)
    {
        $voter = Voter::findOrFail($id);
        $voter->delete();

        return redirect()->route('voter-management.index')->with('success', 'Voter berhasil dihapus.');
    }
} 