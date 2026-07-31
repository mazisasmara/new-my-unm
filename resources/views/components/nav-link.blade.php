@props(['active' => false])

<a {{ $attributes }}
aria-current="{{ $active ? 'page' : false }}" class="block rounded-md {{ $active ? 'bg-gray-950/50 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-sm font-medium">{{ $slot }}</a>
