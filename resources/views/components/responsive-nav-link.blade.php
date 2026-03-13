@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 text-start text-base font-bold focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium focus:outline-none transition duration-150 ease-in-out';
$activeStyle = 'border-color: #F07B3F; color: #F07B3F; background-color: rgba(240, 123, 63, 0.1);';
$inactiveStyle = 'color: #EEEEEE;';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}
   style="{{ ($active ?? false) ? $activeStyle : $inactiveStyle }}"
   onmouseover="this.style.backgroundColor='rgba(238, 238, 238, 0.1)'; this.style.color='#F07B3F';"
   onmouseout="@php echo ($active ?? false) ? "this.style.backgroundColor='rgba(240, 123, 63, 0.1)'; this.style.color='#F07B3F';" : "this.style.backgroundColor='transparent'; this.style.color='#EEEEEE';" @endphp">
    {{ $slot }}
</a>
