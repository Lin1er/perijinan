<button type="submit"
    class="bg-{{ $color }}-500 hover:bg-{{ $color }}-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline
           {{ $size === 'lg' ? 'text-lg' : ($size === 'sm' ? 'text-sm' : 'text-base') }}">
    {{ $slot }}
</button>
