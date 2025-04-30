@extends('layouts.admin')

@section('title', 'Voter Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-lg font-semibold text-gray-800">Voter Management</h2>
    <div class="space-x-2">
        <a href="{{ route('voter-management.create') }}" class="inline-block bg-primary text-white px-4 py-2 rounded-lg shadow hover:bg-accent transition">Add Voter</a>
        <form action="{{ route('voter-management.import') }}" method="POST" enctype="multipart/form-data" class="inline-block">
            @csrf
            <input type="file" name="file" required class="inline-block border rounded p-1 text-sm">
            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">Import Excel</button>
        </form>
        <a href="{{ route('voter-management.export') }}" class="inline-block bg-accent text-white px-4 py-2 rounded-lg shadow hover:bg-primary transition">Export</a>
    </div>
</div>
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Voting Code</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($voters as $voter)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $voter->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $voter->identifier }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-mono font-bold text-blue-600">{{ $voter->voting_code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($voter->vote)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Voted</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Not Voted</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button type="button"
                            onclick="openDeleteModal('{{ route('voter-management.destroy', $voter->id) }}')"
                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition text-xs">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl items-center p-8 max-w-sm w-full shadow-lg text-center">
        <h3 class="text-xl font-bold text-red-600 mb-4">Konfirmasi Hapus</h3>
        <p class="mb-6 text-gray-700">Apakah Anda yakin ingin menghapus voter ini?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex items-center justify-between">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600">Hapus</button>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
function openDeleteModal(actionUrl) {
    document.getElementById('deleteForm').action = actionUrl;
    document.getElementById('deleteModal').classList.remove('hidden');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>