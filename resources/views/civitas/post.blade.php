@extends('layout.app')
    @section('content')
        <div class="form-portion bg-stone-100 sm:w-[80%] w-[90%] mx-auto">
            <form class="p-5 mt-5  bg-gray-300 rounded-lg" action="/civitas/post" method="post" enctype="multipart/form-data">
                @csrf
                <div class="md:p-5 p-1 sm:mt-1 mt-1">
                    <div class="md:mt-1 mt-2">
                        <label for="subject" class="mb-2 text-sm font-medium text-gray-900">Title : </label><br>
                        <input type="text" name="title" placeholder="Mention your area of concern"
                            class="w-[100%] px-4 py-2 mt-1 rounded-xl dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="md:mt-1 mt-2">
                        <label for="category" class="mb-2 text-sm font-medium text-gray-900">Category : </label><br>
                        <select id="category" name="category" class=" w-[100%] px-4 py-2 mt-1 rounded-xl dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @if (isset($categories))    
                        @foreach ($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->category }}</option>
                        @endforeach
                        @endif
                        </select>
                    </div>

                    <div class="md:mt-1 mt-2">
                        <label class="mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                            <input id="upload" class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" name="photo">
                            @error('photo')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                            @enderror
                    </div>

                    <div class="md:mt-1 mt-2">
                        <div id="image-preview" class="w-[27%] p-6 bg-gray-100 border-dashed border-2 border-gray-400 rounded-lg  text-center cursor-pointer">
                            <label for="upload" class="cursor-pointer">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-700">Upload picture</h5>
                                    <p class="font-normal text-sm text-gray-400 md:px-6">Choose photo size should be less than <b class="text-gray-600">2mb</b></p>
                                    <p class="font-normal text-sm text-gray-400 md:px-6">and should be in <b class="text-gray-600">JPG, PNG, or GIF</b> format.</p>
                                    <span id="filename" class="text-gray-500 bg-gray-200 z-50"></span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your message</label>
                        <textarea name="post" id="message" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                        @error('post')
                            <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="btn mt-2 w-[100%] bg-transparent flex items-center">
                    <button type="submit"
                        class="bg-blue-700 px-4 py-2 mx-auto rounded-xl text-center text-xl bg-black text-white hover:text-black hover:bg-white hover:font-bold hover:shadow-xl">Send
                        Message</button>
                </div>
            </div>
            </form>
        </div>
        <script>
            const uploadInput = document.getElementById('upload');
            const filenameLabel = document.getElementById('filename');
            const imagePreview = document.getElementById('image-preview');

            // Check if the event listener has been added before
            let isEventListenerAdded = false;

            uploadInput.addEventListener('change', (event) => {
                const file = event.target.files[0];

                if (file) {
                filenameLabel.textContent = file.name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.innerHTML =
                    `<img src="${e.target.result}" class="max-h-48 rounded-lg mx-auto" alt="Image preview" />`;
                    imagePreview.classList.remove('border-dashed', 'border-2', 'border-gray-400');
                    // Add event listener for image preview only once
                    if (!isEventListenerAdded) {
                    imagePreview.addEventListener('click', () => {
                        uploadInput.click();
                    });
                    isEventListenerAdded = true;
                    }
                };
                reader.readAsDataURL(file);
                } else {
                filenameLabel.textContent = '';
                imagePreview.innerHTML =
                    `<div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center text-gray-500">No image preview</div>`;
                imagePreview.classList.add('border-dashed', 'border-2', 'border-gray-400');

                // Remove the event listener when there's no image
                imagePreview.removeEventListener('click', () => {
                    uploadInput.click();
                });

                isEventListenerAdded = false;
                }
            });
            uploadInput.addEventListener('click', (event) => {
                event.stopPropagation();
            });
            </script>
    @endsection
