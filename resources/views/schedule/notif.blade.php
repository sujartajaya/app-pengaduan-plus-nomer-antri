@extends('layout.app')
    @section('content')
        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
                <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
                    <?php 
                        use App\Models\Post;
                        use App\Models\Category;

                        $categories = Category::get();
                     ?>
                    @foreach ($antrian as $antri)
                    <?php  
                        $post = Post::where('id',$antri->post_id)->get()->first();
                    ?>
                    <div
                        class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                        <div id="image-preview" class="p-6 bg-gray-100 border-dashed border-2 border-gray-400 text-center cursor-pointer">
                            <img src="{{'/storage/'.$post->photo}}" class="max-h-48 mx-auto mb-3">
                        </div>
                        <div class="p-4 pt-2">
                            <div class="mb-8">
                                <p class="text-sm text-gray-600 flex items-center">
                                    <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z">
                                        </path>
                                    </svg>
                                    Members only
                                </p>
                                <a href="#" class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">{{ $post->title }}</a>
                                <p class="text-gray-700 font-bold text-lg">Category: 
                                    <?php 
                                        foreach ($categories as $category)
                                        {
                                            if ($category->id == $post->category_id) {
                                                echo $category->category;
                                            }
                                        }
                                    ?>
                                </p>
                                <p class="text-gray-700 text-sm">{{ $post->post }}</p>
                                <div class="bg-gradient-to-br from-purple-600 to-indigo-600 text-white text-center py-5 px-20 rounded-lg shadow-md relative cursor-pointer">
                                        <p>{{ $antri->number }}</p>  
                                    <div class="w-4 h-4 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 left-3 -ml-6"></div>
                                    <div class="w-4 h-4 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 right-3 -mr-6"></div>
                                </div>
                            </div>
                            <form method="post" action="/civitas/checkin">
                            @csrf
                            <input type="hidden" name="antri_id" value="{{ $antri->id }}" />
                            <div class="flex gap-2 px-2">
                                <button type="submit"
                                class="flex-1 rounded-full bg-blue-600 dark:bg-blue-800 text-white dark:text-white antialiased font-bold hover:bg-blue-800 dark:hover:bg-blue-900 px-4 py-2 text-center">
                                Checkin!
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
    @endsection
