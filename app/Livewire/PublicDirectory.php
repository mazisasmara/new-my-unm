<?php

namespace App\Livewire;

use App\Models\Kategori;
use App\Models\User;
use Livewire\Component;

class PublicDirectory extends Component
{
    public int $kategoriId;

    public string $kind;

    public ?string $search = null;

    public ?string $owner = null;

    public function mount(int $kategoriId, string $kind, ?string $search = null, ?string $owner = null): void
    {
        abort_unless(in_array($kind, ['layanan', 'prodi'], true), 404);

        $this->kategoriId = $kategoriId;
        $this->kind = $kind;
        $this->search = $search;
        $this->owner = $owner;
    }

    public function render()
    {
        $filteredUser = $this->owner
            ? User::where('username', $this->owner)->where('role', 'admin')->firstOrFail()
            : null;

        $kategori = Kategori::whereKey($this->kategoriId)
            ->with(['groups' => function ($query) {
                $query->where('status', true)->orderBy('urutan');
            }, $this->kind === 'prodi' ? 'groups.prodis' : 'groups.layanans' => function ($query) use ($filteredUser) {
                $query->where('status', true)->orderBy('urutan');
                if ($this->kind === 'layanan') {
                    $query->filter($this->search)
                        ->when($filteredUser, fn ($q) => $q->byUser($filteredUser->id))
                        ->with('creator');
                } else {
                    $query->with('links');
                }
            }])->firstOrFail();

        return view('livewire.public-directory', compact('kategori'));
    }
}
