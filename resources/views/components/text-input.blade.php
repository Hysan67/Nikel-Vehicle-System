@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-sm px-4 py-3 text-lg shadow-sm border-2 border-gray-300 focus:border-[#2D4059] focus:ring focus:ring-[#2D4059] focus:ring-opacity-50 w-full text-[#2D4059] bg-white transition-colors duration-200']) }}>
