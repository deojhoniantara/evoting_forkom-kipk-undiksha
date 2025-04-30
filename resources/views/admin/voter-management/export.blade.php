@extends('layouts.admin')

@section('title', 'Export Voting Code')

@section('content')
<div class="flex justify-between items-center mb-6 print:hidden">
    <h2 class="text-lg font-semibold text-gray-800">Export Voting Codes</h2>
    <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
        Cetak Daftar
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Kode Voting</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($voters as $index => $voter)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $voter->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $voter->identifier }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-mono font-bold text-blue-600">{{ $voter->voting_code }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
