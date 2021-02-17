@props(['name', 'label', 'default' => null])

<label for="{{ $name }}" class="mb-1 mt-3">
    {{ $label }}
</label>

<input name="{{ $name }}"
       id="{{ $name }}"
       value="{{ old($name, $default) }}"
       {{ $attributes }}
       class="px-3 py-2 rounded-lg border border-gray-300 dark:bg-gray-600"/>

@error($name)
<div class="text-red-800 dark:text-red-500 mt-1">
    {{ $message }}
</div>
@enderror
