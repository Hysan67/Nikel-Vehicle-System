<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 focus:outline-none transition duration-150 ease-in-out']) }}
   style="color: #2D4059;"
   onmouseover="this.style.backgroundColor='#EEEEEE'; this.style.color='#F07B3F';"
   onmouseout="this.style.backgroundColor=''; this.style.color='#2D4059';">{{ $slot }}</a>
