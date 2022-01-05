<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-800">
    <div style="background-color: #fedc00" class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-500 shadow-md overflow-hidden sm:rounded-tl-md sm:rounded-tr-md text-center">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-0 px-6 py-4 bg-gray-500 shadow-md overflow-hidden sm:rounded-bl-md sm:rounded-br-md">
        {{ $slot }}
    </div>
</div>
