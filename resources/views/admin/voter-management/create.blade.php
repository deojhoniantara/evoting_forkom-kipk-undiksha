@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-sm p-8 mt-8">
    <h2 class="text-2xl font-bold text-primary mb-6">Tambah Pemilih Baru</h2>
    @if($errors->any())
    <div class="mb-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <form action="{{ route('voter-management.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Pemilih</label>
            <input type="text" 
                   name="name" 
                   id="name" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   value="{{ old('name') }}"
                   required>
        </div>
        <div class="mb-6">
            <label for="identifier" class="block text-gray-700 text-sm font-bold mb-2">Identifier (NIM)</label>
            <input type="text" 
                   name="identifier" 
                   id="identifier" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   value="{{ old('identifier') }}"
                   required>
            <p class="text-gray-600 text-xs italic mt-1">Identifier harus unik untuk setiap pemilih</p>
        </div>
        <div class="flex items-center justify-between">
        <a href="{{ route('voter-management.index') }}" class="text-gray-600 hover:text-gray-800">Kembali</a>
        <button type="submit" class="bg-primary hover:bg-accent text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">Simpan</button>
        </div>
    </form>
</div>
@endsection 