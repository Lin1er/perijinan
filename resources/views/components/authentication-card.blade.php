<div {{ $attributes->merge(['class' => 'min-h-screen flex flex-col sm:justify-center items-center pt-6  bg-gray-100'])->class(['bg-gray-800 rounded-md' => !$attributes->has('class')]) }}>

    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
