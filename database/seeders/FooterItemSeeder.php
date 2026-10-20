<?php

namespace Database\Seeders;

use App\Models\FooterItem;
use Illuminate\Database\Seeder;

class FooterItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'type' => 'contact',
                'label' => 'Alamat',
                'value' => "Menara Pinisi UNM\nJl. A. P. Pettarani, Makassar 90222",
                'url' => 'https://maps.google.com/?q=Menara+Pinisi+UNM+Makassar',
                'icon' => 'location',
                'urutan' => 1,
            ],
            [
                'type' => 'contact',
                'label' => 'Email',
                'value' => 'info@unm.ac.id',
                'url' => 'mailto:info@unm.ac.id',
                'icon' => 'email',
                'urutan' => 2,
            ],
            [
                'type' => 'contact',
                'label' => 'Telepon',
                'value' => '(0411) 3987077',
                'url' => 'tel:+624113987077',
                'icon' => 'phone',
                'urutan' => 3,
            ],
            [
                'type' => 'social',
                'label' => 'Website UNM',
                'value' => 'unm.ac.id',
                'url' => 'https://unm.ac.id/',
                'icon' => 'website',
                'urutan' => 1,
            ],
            [
                'type' => 'social',
                'label' => 'Instagram UNM',
                'value' => '@unm.makassar',
                'url' => 'https://www.instagram.com/unm.makassar/',
                'icon' => 'instagram',
                'urutan' => 2,
            ],
            [
                'type' => 'social',
                'label' => 'YouTube UNM',
                'value' => 'Universitas Negeri Makassar',
                'url' => 'https://www.youtube.com/channel/UCc9sGy38WuMkKANDJGgMF5Q',
                'icon' => 'youtube',
                'urutan' => 3,
            ],
        ];

        FooterItem::query()->delete();

        foreach ($items as $item) {
            FooterItem::create($item + ['status' => true]);
        }
    }
}
