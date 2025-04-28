@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Quick Stats -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-primary/10">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Voters</h3>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalVoters }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-accent/10">
                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Votes</h3>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalVotes }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Voting Progress</h3>
                <p class="text-2xl font-semibold text-gray-800">{{ number_format(($totalVotes / $totalVoters) * 100, 1) }}%</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="mt-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h2>
        <div class="space-y-4">
            @foreach($recentVotes as $vote)
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">
                        <span class="font-medium text-gray-800">{{ $vote->voter->name }}</span> NIM 
                        <span class="font-bold text-gray-600">{{ $vote->voter->identifier }}</span>
                    </p>
                    <p class="text-xs text-gray-500">{{ $vote->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
