@extends('layout.app')
    @section('content')
        <div class="flex justify-center w-full">
                    <div
                        class="border-r border-b border-l border-gray-400 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                        <div id="image-preview" class="p-6 bg-gray-100 border-dashed border-2 border-gray-400 text-center cursor-pointer">
                            <a href="/civitas/post/photo/{{ $category->post[0]->uuid }}"><img src="{{'/storage/'.$category->post[0]->photo}}" class="max-h-48 mx-auto mb-3"></a>
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
                                <a href="#" class="text-gray-900 font-bold text-lg mb-2 hover:text-indigo-600 inline-block">{{ $category->post[0]->title }}</a>
                                <p class="text-gray-700 font-bold text-lg">Category: 
                                        {{ $category->category }}
                                </p>
                                <p class="text-gray-700 text-sm">{{ $category->post[0]->post }}</p>
                                <p>&nbsp;</p>
                                <div class="bg-gradient-to-br from-purple-600 to-indigo-600 text-white text-center py-5 px-20 rounded-lg shadow-md relative">
                                    @if (is_null($queue))
                                        <p>Belum ada nomor antre</p>
                                    @else
                                        {{ $queue->number }}
                                    @endif
                                    <div class="w-4 h-4 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 left-3 -ml-6"></div>
                                    <div class="w-4 h-4 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 right-3 -mr-6"></div>
                                </div>
                                <p>&nbsp;</p>
                                <p class="text-gray-700 text-sm">Silakan pilih tanggal untuk mendapatkan nomer antre:</p>
                            <form action="/civitas/post/schedule/{{$category->post[0]->uuid}}" method="post">
                                @csrf
                                    <input type="date" name="tanggal" class="w-[100%] px-4 py-2 mt-1 rounded-xl dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 bg-gray-800 text-white" autofocus value="{{ old('tanggal') }}">
                                     @error('tanggal')
                                     <div class="invalid block text-sm font-medium text-red-700 dark:text-red-600 mb-2">{{$message}}</div>
                        @enderror
                            </div>
                            <div class="flex gap-2 px-2">
                                <button type="submit"
                                class="flex-1 rounded-full bg-blue-600 dark:bg-blue-800 text-white dark:text-white antialiased font-bold hover:bg-blue-800 dark:hover:bg-blue-900 px-4 py-2 text-center" <?php if ($queue) echo "disabled" ?> >
                                Update
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
        </div>
    @endsection
