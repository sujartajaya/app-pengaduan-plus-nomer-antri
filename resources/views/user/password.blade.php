@extends('layout.app')
    @section('content')
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 mt-10">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Change Password
                    </h1>
                    @if (session('message'))
                    <h5 class="alert alert-success mb-2 dark:text-white text-gray-700">{{ session('message') }}</h5>
                    @endif
                    <form class="space-y-4 md:space-y-6" action="/user/password" method="post">
                        @csrf
                        
                        <div>
                            <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your current password</label>
                            <input type="password" name="current_password" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••" required="" value="{{ old('email') }}">
                            @error('current_password')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @error('password')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input type="confirm_password" name="confirm_password" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""> 
                            @error('confirm_password')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="flex gap-2 px-2">
                            <button type="submit" class="flex-1 rounded-full border-2 bg-red-600 border-gray-400 dark:border-gray-700 font-semibold text-white dark:text-white px-4 py-2 hover:bg-red-800">Update</button>
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
