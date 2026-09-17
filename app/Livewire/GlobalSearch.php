<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Prodi;
use App\Models\ProdiLink;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GlobalSearch extends Component
{
    public string $query = '';

    public string $formAction;

    public array $preservedQuery = [];

    public ?string $ownerUsername = null;

    public function mount(
        string $formAction,
        array $preservedQuery = [],
        ?string $ownerUsername = null,
        ?string $initialQuery = null,
    ): void {
        $this->formAction = $formAction;
        $this->preservedQuery = $preservedQuery;
        $this->ownerUsername = $ownerUsername;
        $this->query = $initialQuery ?? '';
    }

    #[Computed]
    public function suggestions(): array
    {
        $keyword = trim($this->query);

        if ($keyword === '') {
            return [];
        }

        $patterns = collect(preg_split('/\s+/u', $keyword, -1, PREG_SPLIT_NO_EMPTY))
            ->filter(fn (string $word) => Str::length($word) >= 2)
            ->prepend($keyword)
            ->unique(fn (string $word) => Str::lower($word))
            ->map(fn (string $word) => '%'.$word.'%')
            ->values()
            ->all();
        $items = [];

        Kategori::query()
            ->where(fn (Builder $query) => $this->whereMatches($query, ['nama_kategori', 'slug'], $patterns))
            ->orderBy('urutan')
            ->limit(10)
            ->get(['id', 'nama_kategori', 'slug'])
            ->each(function (Kategori $kategori) use (&$items, $keyword) {
                $items[] = $this->result(
                    $kategori->nama_kategori,
                    'Bagian Website',
                    $this->categoryUrl($kategori->slug),
                    $keyword,
                    $kategori->slug,
                );
            });

        Group::query()
            ->with('kategori:id,nama_kategori,slug')
            ->where('status', true)
            ->where(fn (Builder $query) => $this->whereMatches($query, ['nama_group', 'slug'], $patterns))
            ->orderBy('urutan')
            ->limit(12)
            ->get(['id', 'kategori_id', 'nama_group', 'slug'])
            ->each(function (Group $group) use (&$items, $keyword) {
                $type = $group->kategori?->slug === 'fakultas'
                    ? 'Fakultas'
                    : ($group->kategori?->nama_kategori ?? 'Unit');
                $url = $this->categoryUrl($group->kategori?->slug);

                $items[] = $this->result($group->nama_group, $type, $url, $keyword, $group->slug);
            });

        Layanan::query()
            ->with('group.kategori:id,nama_kategori,slug')
            ->where('status', true)
            ->whereHas('group', fn ($query) => $query->where('status', true))
            ->where(fn (Builder $query) => $this->whereMatches($query, ['nama_layanan', 'deskripsi'], $patterns))
            ->orderBy('urutan')
            ->limit(12)
            ->get(['id', 'group_id', 'nama_layanan', 'deskripsi'])
            ->each(function (Layanan $layanan) use (&$items, $keyword) {
                $items[] = $this->result(
                    $layanan->nama_layanan,
                    'Layanan',
                    route('layanan.show', $layanan),
                    $keyword,
                    $layanan->deskripsi,
                );
            });

        Prodi::query()
            ->with('group.kategori:id,nama_kategori,slug')
            ->where('status', true)
            ->whereHas('group', fn ($query) => $query->where('status', true))
            ->where(fn (Builder $query) => $this->whereMatches($query, ['judul'], $patterns))
            ->orderBy('urutan')
            ->limit(12)
            ->get(['id', 'group_id', 'judul'])
            ->each(function (Prodi $prodi) use (&$items, $keyword) {
                $url = $this->categoryUrl($prodi->group?->kategori?->slug).'#prodi-'.$prodi->id;
                $items[] = $this->result($prodi->judul, 'Program Studi', $url, $keyword);
            });

        ProdiLink::query()
            ->with('prodi.group.kategori:id,nama_kategori,slug')
            ->whereHas('prodi', fn ($query) => $query
                ->where('status', true)
                ->whereHas('group', fn ($group) => $group->where('status', true)))
            ->where(fn (Builder $query) => $this->whereMatches($query, ['label'], $patterns))
            ->orderBy('urutan')
            ->limit(10)
            ->get(['id', 'prodi_id', 'label'])
            ->each(function (ProdiLink $link) use (&$items, $keyword) {
                $items[] = $this->result(
                    $link->label,
                    'Tautan Program Studi',
                    route('prodi-link.visit', $link),
                    $keyword,
                );
            });

        usort($items, function (array $left, array $right): int {
            return ($right['score'] <=> $left['score'])
                ?: strcasecmp($left['title'], $right['title']);
        });

        return array_slice($items, 0, 8);
    }

    public function render()
    {
        return view('livewire.global-search');
    }

    private function result(
        string $title,
        string $type,
        string $url,
        string $keyword,
        ?string $secondary = null,
    ): array {
        return [
            'title' => $title,
            'type' => $type,
            'url' => $url,
            'score' => $this->relevance($title, $keyword, $secondary),
        ];
    }

    private function relevance(string $title, string $keyword, ?string $secondary = null): int
    {
        $title = Str::lower(trim($title));
        $keyword = Str::lower(trim($keyword));
        $secondary = Str::lower((string) $secondary);

        if ($title === $keyword) {
            return 500;
        }

        if (Str::startsWith($title, $keyword)) {
            return 400;
        }

        if (Str::contains($title, $keyword)) {
            return 300;
        }

        if (Str::contains($secondary, $keyword)) {
            return 200;
        }

        $words = collect(preg_split('/\s+/u', $keyword, -1, PREG_SPLIT_NO_EMPTY))
            ->filter(fn (string $word) => Str::length($word) >= 2);
        $titleMatches = $words->filter(fn (string $word) => Str::contains($title, $word))->count();
        $secondaryMatches = $words->filter(fn (string $word) => Str::contains($secondary, $word))->count();

        return 100 + ($titleMatches * 25) + ($secondaryMatches * 10);
    }

    private function categoryUrl(?string $slug): string
    {
        return ! $slug || $slug === 'universitas' ? route('home') : url($slug);
    }

    private function whereMatches(Builder $query, array $fields, array $patterns): void
    {
        foreach ($fields as $field) {
            foreach ($patterns as $pattern) {
                $query->orWhere($field, 'like', $pattern);
            }
        }
    }
}
