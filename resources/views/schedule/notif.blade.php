@extends('layout.app')
    @section('content')
            <div class="flex justify-center items-center">
            <table class="w-50% text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 shadow-md">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Antri
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($antrian as $antri)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{ $count = $count + 1}}
                        </th>
                        <td class="px-6 py-4">
                            {{ $antri->tanggal }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $antri->number }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="/civitas/schedule/view/{{ $antri->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                            &nbsp;
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Checkin</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
    @endsection
