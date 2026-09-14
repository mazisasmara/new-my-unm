<?php

namespace App\Livewire;

use App\Models\Prodi;
use Livewire\Component;

class ManagedProdiList extends Component
{
    public ?string $search = null;

    public ?string $status = null;

    public ?string $group = null;

    public function mount(?string $search = null, ?string $status = null, ?string $group = null): void
    {
        $this->search = $search;
        $this->status = $status;
        $this->group = $group;
    }

    public function render()
    {
        $user = auth()->user();
        abort_unless($user && in_array($user->role, ['admin', 'superadmin'], true), 403);
        abort_unless($user->isSuperAdmin() || $user->group?->kategori?->slug === 'portal-prodi', 403);

        $prodis = Prodi::with(['links', 'group.user', 'creator'])
            ->when(! $user->isSuperAdmin(), fn ($q) => $q->where('group_id', $user->group_id))
            ->when($this->search, fn ($q, $search) => $q->where(fn ($nested) => $nested->where('judul', 'like', "%{$search}%")->orWhereHas('links', fn ($links) => $links->where('label', 'like', "%{$search}%"))))
            ->when($this->status !== null && $this->status !== '', fn ($q) => $q->where('status', $this->status))
            ->when($user->isSuperAdmin() && $this->group, fn ($q) => $q->where('group_id', $this->group))
            ->orderBy('urutan')->get();

        return view('livewire.managed-prodi-list', compact('prodis'));
    }
}
