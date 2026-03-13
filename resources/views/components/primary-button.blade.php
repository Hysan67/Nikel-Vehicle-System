<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-3 bg-[#2D4059] border border-transparent rounded-lg border-b-4 border-b-[#F07B3F] font-bold text-sm text-[#EEEEEE] uppercase tracking-wider hover:bg-[#1a2533] hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-[#2D4059] focus:ring-offset-2 transition-all duration-200 shadow-md']) }}>
    {{ $slot }}
</button>
