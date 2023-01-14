<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h1 class="text-center"> Latest {{count($results)}} Winning Results</h1>
                    <div class="grid grid-cols-3 gap-3 mt-4">
                        @foreach($results as $result)
                            <div class="text-center border">
                                <h2>Amount</h2>
                                {{$result}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<?php
