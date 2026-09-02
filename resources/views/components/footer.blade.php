<footer class="w-full text-white" style="background-color: #ff7900;">
    <div class="mx-auto flex max-w-7xl flex-col gap-6 px-6 py-4 md:flex-row md:items-center md:gap-4 lg:px-8">
        <div class="flex justify-center md:w-1/3 md:justify-start">
            <img src="{{ asset('storage/layanan-logo/logo-myunm.png') }}" alt="Universitas Negeri Makassar" class="h-20 w-44 max-w-full object-contain">
        </div>

        <section class="mx-auto text-sm text-slate-950 md:w-1/3">
            <div class="mb-2 flex items-center gap-2 text-lg font-medium text-white">
                <svg class="size-5 text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.75 9.75 0 01-4.255-.972L3 20l1.315-3.945A7.67 7.67 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                <h2>Hubungi kami :</h2>
            </div>
            <ul class="space-y-1">
                @foreach($contacts as $contact)
                    <li class="flex items-start gap-2">
                        @if($contact->icon === 'location')
                            <svg class="mt-0.5 size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21s7-5.25 7-12a7 7 0 10-14 0c0 6.75 7 12 7 12z" /><circle cx="12" cy="9" r="2" stroke-width="2" /></svg>
                        @elseif($contact->icon === 'email')
                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6m0 10H3V6h18v12z" /></svg>
                        @elseif($contact->icon === 'phone')
                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3l2 5-2.5 1.5a11 11 0 005 5L14 12l5 2v3a2 2 0 01-2 2C9.268 19 3 12.732 3 5z" /></svg>
                        @else
                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke-width="2" /><path d="M8 12h8" stroke-width="2" /></svg>
                        @endif
                        @if($contact->url)<a href="{{ $contact->url }}" class="whitespace-pre-line hover:underline">{{ $contact->value }}</a>@else<span class="whitespace-pre-line">{{ $contact->value }}</span>@endif
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="mx-auto w-fit md:ml-auto md:mr-0" aria-label="Media sosial">
            <div class="flex items-center gap-2.5">
                @foreach($socialLinks as $social)
                    <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social->label }}" class="flex size-10 items-center justify-center rounded-full bg-black text-white transition hover:bg-slate-800">
                        @if($social->icon === 'youtube')<svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.58 7.19a2.95 2.95 0 00-2.08-2.09C17.67 4.6 12 4.6 12 4.6s-5.67 0-7.5.5a2.95 2.95 0 00-2.08 2.09A30.4 30.4 0 002 12a30.4 30.4 0 00.42 4.81 2.95 2.95 0 002.08 2.09c1.83.5 7.5.5 7.5.5s5.67 0 7.5-.5a2.95 2.95 0 002.08-2.09A30.4 30.4 0 0022 12a30.4 30.4 0 00-.42-4.81zM10 15.5v-7l6 3.5-6 3.5z" /></svg>
                        @elseif($social->icon === 'instagram')<svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" stroke-width="2" /><circle cx="12" cy="12" r="4" stroke-width="2" /><circle cx="17.5" cy="6.5" r="1" fill="currentColor" /></svg>
                        @elseif($social->icon === 'facebook')<svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.5 21v-8h2.75l.41-3h-3.16V8.08c0-.87.25-1.46 1.5-1.46h1.76V3.94A23.6 23.6 0 0015.05 3C12.37 3 10.5 4.64 10.5 7.66V10H8v3h2.5v8h3z" /></svg>
                        @elseif($social->icon === 'whatsapp')<svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.5 3.5A11.8 11.8 0 0012.05 0C5.54 0 .24 5.3.24 11.82c0 2.08.54 4.1 1.57 5.87L.14 24l6.47-1.7a11.8 11.8 0 005.44 1.34h.01c6.51 0 11.81-5.3 11.81-11.82 0-3.15-1.23-6.1-3.37-8.32zm-8.45 18.15a9.8 9.8 0 01-5-1.37l-.36-.21-3.84 1 1.03-3.74-.23-.39a9.8 9.8 0 01-1.5-5.13c0-5.45 4.44-9.88 9.9-9.88a9.82 9.82 0 017 2.9 9.76 9.76 0 012.9 6.98c0 5.45-4.44 9.89-9.9 9.89z" /></svg>
                        @elseif($social->icon === 'linkedin')<span class="text-sm font-black">in</span>
                        @elseif($social->icon === 'tiktok')<span class="text-lg font-black">♪</span>
                        @else<svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-width="2" d="M3 12h18M12 3a15 15 0 010 18M12 3a15 15 0 000 18"/></svg>@endif
                    </a>
                @endforeach
            </div>
            <div class="mt-3 h-px w-[190px] bg-white"></div>
        </section>
    </div>

    <div class="border-t border-black/70 px-4 py-2 text-center text-[13px] text-white">
        Copyright © {{ now()->year }} Universitas Negeri Makassar. Dikelola oleh UPT TIK UNM
    </div>
</footer>
