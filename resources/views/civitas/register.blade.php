@extends('layout.app')
    @section('content')
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 mt-10">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Welcome {{ Auth::user()->name }}, please complate your register!
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="/civitas/register" method="post">
                        @csrf
                        <div>
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM</label>
                            <input type="text" name="nim" id="nim" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="NIM" required="" autofocus value="{{ old('nim') }}">
                            @error('nim')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="fakultas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fakultas</label>
                            <input type="text" name="fakultas" id="fakultas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Fakultas" required=""  value="{{ old('fakultas') }}">
                            @error('fakultas')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="prodi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prodi</label>
                            <input type="text" name="prodi" id="prodi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="prodi" required=""  value="{{ old('prodi') }}">
                            @error('prodi')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <textarea id="message" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address"></textarea>
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
                    </form>
                </div>
            </div>
    </div>
    @endsection
