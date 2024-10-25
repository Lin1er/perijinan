<!-- resources/views/components/table.blade.php -->
<div {{ $attributes->merge(['class' => 'overflow-x-auto relative']) }}>
    <table class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                {{ $header }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
