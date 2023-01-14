<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{--            {{ __('Dashboard') }}--}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                @if(auth()->user()->generated_link)
                <div id="generated_link" class="p-6 text-gray-900" generatedLink ="{{auth()->user()->generated_link}}">
                    <a class="btn-green p-2 m-3 rounded" href='{{auth()->user()->generated_link}}'>go to generated  unique link</a>
                    <button  class="bg-gray-600 text-white p-2 m-3 rounded" onclick="copyLink()">Copy unique link</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function copyLink() {
        let copyText = document.getElementById("generated_link").getAttribute('generatedLink');
        navigator.clipboard.writeText(copyText);
    }
</script>
