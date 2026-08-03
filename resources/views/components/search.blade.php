<form class="max-w-md mx-auto py-3" method="GET">
    <label for="search" class="sr-only">Cari</label>

    <div class="relative">
        <div
            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
        >
            <svg
                class="w-4 h-4 text-gray-500"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-width="2"
                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                />
            </svg>
        </div>

        <input
            type="search"
            id="search"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari layanan..."
            class="block w-full p-3 pl-10 pr-44 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        />

        <div class="absolute right-1.5 bottom-1.5 flex gap-1">
            @if (request('user'))
                <a
                    href="{{ request()->fullUrlWithQuery(['user' => null]) }}"
                    class="px-2 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-md hover:bg-red-100"
                >
                    Hapus
                </a>
            @endif

            <button
                type="submit"
                class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700"
            >
                Search
            </button>
        </div>
    </div>
</form>
