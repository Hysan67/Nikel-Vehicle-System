@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-[#2D4059]']) }}>
    {{ $value ?? $slot }}
</label>
