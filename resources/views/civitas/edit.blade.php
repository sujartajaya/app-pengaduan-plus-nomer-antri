@extends('layout.app')
    @section('content')
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 mt-10">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Welcome {{ Auth::user()->name }}, edit data
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="/civitas/edit" method="post">
                        @csrf
                        <input type='hidden' name='_method' value='PATCH'>
                        <div>
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM</label>
                            <input type="text" name="nim" id="nim" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="NIM" value="{{ $data->nim }}" disabled>
                            @error('nim')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="fakultas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fakultas</label>
                            <input type="text" name="fakultas" id="fakultas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fakultas" required=""  value="{{ $data->fakultas }}" autofocus>
                            @error('fakultas')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="prodi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prodi</label>
                            <input type="text" name="prodi" id="prodi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="prodi" required=""  value="{{ $data->prodi }}">
                            @error('prodi')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <textarea id="message" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address">{{ $data->address }}</textarea>
                        </div>
                        <div class="flex gap-2 px-2">
                                <button type="submit" class="flex-1 rounded-full border-2 bg-red-600 border-gray-400 dark:border-blue-700 font-semibold text-white dark:text-white px-4 py-2 hover:bg-red-800 text-center">Update</button>
                                <a href="/civitas" 
                                class="flex-1 rounded-full border-2 bg-blue-600 border-gray-400 dark:border-blue-700 font-semibold text-white dark:text-white px-4 py-2 hover:bg-blue-800 text-center">
                                Cancel
                                </a>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    @endsection
