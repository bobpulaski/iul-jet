<table
    {{ $attributes->merge(['class' => 'w-full table-auto text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400']) }}>
    {{ $slot }}
</table>
