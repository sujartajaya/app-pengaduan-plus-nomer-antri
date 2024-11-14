@extends('layout.app')
    @section('content')
        <div class="form-portion bg-stone-100 sm:w-[80%] w-[90%] mx-auto">
            <form class="p-5 mt-5  bg-gray-300 rounded-lg" action="/civitas/post/edit/{{ $datapost->uuid }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type='hidden' name='_method' value='PATCH'>
                <div class="md:p-5 p-1 sm:mt-1 mt-1">
                    <div class="md:mt-1 mt-2">
                        <label for="subject" class="mb-2 text-sm font-medium text-gray-900">Title : </label><br>
                        <input type="text" name="title" placeholder="Mention your area of concern"
                            class="w-[100%] px-4 py-2 mt-1 rounded-xl dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus value="{{ $datapost->title }}">
                        @error('title')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="md:mt-1 mt-2">
                        <label for="category" class="mb-2 text-sm font-medium text-gray-900">Category : </label><br>
                        <select id="category" name="category_id" class=" w-[100%] px-4 py-2 mt-1 rounded-xl dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @if (isset($categories))    
                        @foreach ($categories as $category)
                            @if($category->id == $datapost->category_id)
                                <option value="{{ $category->id}}" selected>{{ $category->category }}</option>
                            @else
                                <option value="{{ $category->id}}">{{ $category->category }}</option>
                            @endif
                        @endforeach
                        @endif
                        </select>
                    </div>

                    <div class="mt-5">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Complaint description</label>
                        <textarea name="post" id="message" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ $datapost->post }}</textarea>
                        @error('post')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="btn mt-2 w-[100%] bg-transparent flex items-center">
                    <button type="submit"
                        class="bg-blue-700 px-4 py-2 mx-auto rounded-xl text-center text-xl bg-black text-white hover:text-black hover:bg-white hover:font-bold hover:shadow-xl">Update</button>
                </div>
            </form>
        </div>
    @endsection
