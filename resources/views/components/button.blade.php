<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex justify-center items-center px-4 py-2 border border-transparent font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'])->class(['bg-gray-800 rounded-md' => !$attributes->has('class')]) }}>
    {{ $slot }}
</button>
