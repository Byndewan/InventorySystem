@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:mr-8 mb-6 md:mb-0">
                        <div class="h-32 w-32 rounded-full overflow-hidden bg-gray-200">
                            @if (auth()->user()->avatar)
                                <img src="{{ asset('uploads/admin/' . auth()->user()->avatar) }}" alt="Profile Photo"
                                    class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center text-gray-500">
                                    <svg class="h-16 w-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                        <p class="text-gray-600">{{ auth()->user()->email }}</p>
                        <p class="text-gray-500 mt-2">Administrator</p>

                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('profile.edit') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                Perbarui Profil
                            </a>
                            <a href="{{ route('profile.password.edit') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Ubah Kata Sandi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900">Informasi Akun</h3>
                <div class="mt-4 grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Terdaftar Sejak</p>
                        <p class="mt-1 text-sm text-gray-900">{{ auth()->user()->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Terakhir Diperbarui</p>
                        <p class="mt-1 text-sm text-gray-900">{{ auth()->user()->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
