@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ubah Inventaris Barang</h1>
                <p class="mt-1 text-sm text-gray-500">Ubah Detail Untuk Barang {{ $item->name }}</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('items.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="POST" action="{{ route('items.update', $item->id) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}"
                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 transition duration-150 ease-in-out sm:text-sm @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                placeholder="Contoh: Wireless Headphones" required>
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @else
                            <p class="mt-2 text-sm text-gray-500">Masukkan Nama Barang Yang Ingin Di Tambahkan</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tag text-gray-400"></i>
                            </div>
                            <select id="category_id" name="category_id"
                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md appearance-none bg-white transition duration-150 ease-in-out sm:text-sm @error('category_id') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @else
                            <p class="mt-2 text-sm text-gray-500">Pilih Kategori Yang Paling Sesuai</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-layer-group text-gray-400"></i>
                                </div>
                                <input type="number" id="quantity" name="quantity"
                                    value="{{ old('quantity', $item->quantity) }}" min="0"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 transition duration-150 ease-in-out sm:text-sm @error('quantity') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                    required>
                            </div>
                            @error('quantity')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Jumlah Stock Saat Ini</p>
                            @enderror
                        </div>

                        <div>
                            <label for="unit_price" class="block text-sm font-medium text-gray-700">Harga Per Unit</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-dollar-sign text-gray-400"></i>
                                </div>
                                <input type="number" id="unit_price" name="unit_price"
                                    value="{{ old('unit_price', $item->unit_price) }}" min="0" step="0.01"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 transition duration-150 ease-in-out sm:text-sm @error('unit_price') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                    required>
                            </div>
                            @error('unit_price')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Harga Per Unit</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-6 border-t border-gray-200">
                        <button type="button" onclick="window.location='{{ route('items.index') }}'"
                            class="mr-3 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-save mr-2"></i> Perbarui
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
