@extends('layout.app')
    @section('content')
        <div class="form-portion bg-stone-100 sm:w-[80%] w-[90%] mx-auto">
            <form class="p-5 mt-5  bg-gray-300 rounded-lg" action="/civitas/post" method="post" enctype="multipart/form-data">
                @csrf
                <div class="md:p-5 p-1 sm:mt-1 mt-1">
                </div>
            </form>
        </div>
    @endsection
