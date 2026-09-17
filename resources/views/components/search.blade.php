<livewire:global-search
    :form-action="url()->current()"
    :preserved-query="request()->except(['search'])"
    :owner-username="$owner?->username"
    :initial-query="request('search')"
/>
