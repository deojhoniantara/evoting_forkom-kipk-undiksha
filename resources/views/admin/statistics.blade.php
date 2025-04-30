@extends('layouts.admin')

@section('title', 'Statistics')

@section('content')
<div class="mb-8 text-center">
    <h1 class="text-3xl md:text-4xl font-extrabold text-primary mb-2">Voting Statistics</h1>
    <p class="text-gray-600">Visualisasi data hasil pemilihan secara real-time</p>
</div>
<div id="vote-results" class="bg-white rounded-2xl shadow-2xl p-8 hover:shadow-primary/30 transition-all duration-300">
    <h2 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Votes by Candidate
    </h2>
    <div class="h-80 relative">
        <canvas id="votesByCandidateChart"></canvas>
    </div>
    <div class="mt-4 flex flex-wrap gap-2">
        @foreach($candidates as $candidate)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary">
                <span class="w-3 h-3 rounded-full mr-2" style="background: linear-gradient(90deg, #4576D3, #4DCEC6);"></span>
                {{ $candidate->name }}
            </span>
        @endforeach
    </div>
</div>

<!-- Detailed Statistics -->
<div class="mt-12">
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold text-primary mb-4">Detailed Statistics</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Candidate</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Votes</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Percentage</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($candidates as $candidate)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $candidate->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $candidate->votes_count }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $totalVotes > 0 ? number_format(($candidate->votes_count / $totalVotes) * 100, 1) : 0 }}%
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Gradient for bar chart
function getBarGradient(ctx) {
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#4576D3');
    gradient.addColorStop(1, '#4DCEC6');
    return gradient;
}

// Votes by Candidate Chart
const votesByCandidateCanvas = document.getElementById('votesByCandidateChart');
const votesByCandidateCtx = votesByCandidateCanvas.getContext('2d');
const barGradient = getBarGradient(votesByCandidateCtx);
const voteChart = new Chart(votesByCandidateCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($candidates->pluck('name')) !!},
        datasets: [{
            label: 'Votes',
            data: {!! json_encode($candidates->pluck('votes_count')) !!},
            backgroundColor: barGradient,
            borderColor: '#4576D3',
            borderWidth: 2,
            borderRadius: 8,
            barThickness: 30
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return ` ${context.dataset.label}: ${context.parsed.x}`;
                    }
                }
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    color: '#4576D3',
                    font: { weight: 'bold' }
                },
                grid: { color: '#E5E7EB' }
            },
            y: {
                ticks: {
                    color: '#4576D3',
                    font: { weight: 'bold' }
                },
                grid: { display: false }
            }
        }
    }
});

// Tambahkan polling real-time
function fetchVoteData() {
    fetch('/vote-result')
        .then(response => response.json())
        .then(data => {
            const labels = data.candidates.map(c => c.name);
            const values = data.candidates.map(c => c.votes_count);
            voteChart.data.labels = labels;
            voteChart.data.datasets[0].data = values;
            voteChart.update();
        })
        .catch(error => console.error('Polling error:', error));
}

setInterval(fetchVoteData, 5000);


// Voting Progress Chart
const votingProgressCtx = document.getElementById('votingProgressChart').getContext('2d');
new Chart(votingProgressCtx, {
    type: 'doughnut',
    data: {
        labels: ['Voted', 'Not Voted'],
        datasets: [{
            data: [
                {{ $totalVotes }},
                {{ $totalVoters - $totalVotes }}
            ],
            backgroundColor: [
                'rgba(69, 118, 211, 0.9)',
                'rgba(229, 231, 235, 0.9)'
            ],
            borderWidth: 2,
            borderColor: ['#4576D3', '#E5E7EB']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#374151',
                    font: { weight: 'bold' }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return ` ${context.label}: ${context.parsed}`;
                    }
                }
            }
        }
    }
});
</script>
@endsection 