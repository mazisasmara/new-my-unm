<?php

namespace App\Livewire;

use App\Models\Layanan;
use Livewire\Component;

class ManagedLayananList extends Component
{
    public ?string $search = null;

    public ?string $status = null;

    public ?string $group = null;

    public ?string $kategori = null;

    public function mount(?string $search = null, ?string $status = null, ?string $group = null, ?string $kategori = null): void
    {
        $this->search = $search;
        $this->status = $status;
        $this->group = $group;
        $this->kategori = $kategori;
    }

    public function render()
    {
        abort_unless(auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin'], true), 403);
        $user = auth()->user();
        $layanans = Layanan::with(['group.kategori', 'group.user', 'creator'])
            ->when(! $user->isSuperAdmin(), fn ($q) => $q->where('group_id', $user->group_id))
            ->filter($this->search)
            ->when($this->status !== null && $this->status !== '', fn ($q) => $q->where('status', $this->status))
            ->when($user->isSuperAdmin() && $this->group, fn ($q) => $q->where('group_id', $this->group))
            ->when($user->isSuperAdmin() && $this->kategori, fn ($q) => $q->whereHas('group', fn ($g) => $g->where('kategori_id', $this->kategori)))
            ->orderBy('urutan')->get();

        return view('livewire.managed-layanan-list', compact('layanans'));
    }
}
