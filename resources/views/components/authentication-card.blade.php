<div {{ $attributes->merge(['class' => 'min-h-fit w-screen flex flex-col items-center'])->class(['bg-gray-800 rounded-md' => !$attributes->has('class')]) }}>
    <div class=" pt-8">
        {{ $logo }}
    </div>

    <div {{ $attributes->merge(['class' => 'w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden'])->class(['bg-white shadow-md bg-transparent sm:rounded-lg' => !$attributes->has('class')]) }}>
        {{ $description }}
    </div>

    <div class="">
        {{ $footer }}
    </div>
</div>
