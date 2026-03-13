@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 pt-1 border-b-2 border-[#F07B3F] text-sm font-bold leading-5 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out';
$activeStyle = 'color: #F07B3F;'; 
$inactiveStyle = 'color: #EEEEEE; opacity: 0.85;';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}
   style="{{ ($active ?? false) ? $activeStyle : $inactiveStyle }}"
   onmouseover="this.style.color='#F07B3F'; this.style.opacity='1';"
   onmouseout="@php echo ($active ?? false) ? '' : "this.style.color='#EEEEEE'; this.style.opacity='0.85';" @endphp">
    {{ $slot }}
</a>
