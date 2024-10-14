<div {{ $attributes->merge(['class' => 'min-h-fit w-screen flex flex-col items-center bg-gray-100'])->class(['bg-gray-800 rounded-md' => !$attributes->has('class')]) }}>
    <div class=" pt-8">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg bg-transparent">
        {{ $slot }}
    </div>
</div>
