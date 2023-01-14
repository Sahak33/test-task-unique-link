<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if($errors->any())
        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
            </svg>
            <p>{{$errors->first()}}.</p>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('unique-link') }}" method="POST">
                    @csrf
                    @method('post')
                    <button class="btn-blue p-2 rounded">
                        Generate a new unique link
                    </button>
                </form>
                <div class="mt-2">
                    <a href="{{ route('lucky-number') }}" class="btn-green p-2 rounded">Im feeling lucky</a>
                    <a href="{{ route('lucky-history') }}" class="bg-indigo-50 p-2 rounded">History</a>
                </div>
                <div class="mt-4 p-2">
                    <ul class="list-disc">
                        @foreach($links as $link)
                            <li>{{$link->generated_links}}
                                <span class="inline-block ml-2">
                                   <form action="{{ route('unique-link-destroy',$link->id) }}" method="POST">
                                        @csrf
                                       @method('delete')
                                        <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#fca5a5" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                            </button>
                                    </form>
                                </span>
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
