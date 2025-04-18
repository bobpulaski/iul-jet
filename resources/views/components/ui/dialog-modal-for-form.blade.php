{{--Вынесено в отдельный файл отличный от Jetstream для того, чтобы кнопка формы попадала в тот же слот, что и поля ввода, иначе, с валидацией проблемы--}}

@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ $title }}
    </div>

    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
        {{ $content }}
    </div>



</x-modal>
