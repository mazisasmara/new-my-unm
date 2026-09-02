<?php

namespace Database\Seeders;

use App\Models\FooterItem;
use Illuminate\Database\Seeder;

class FooterItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['type' => 'contact', 'label' => 'Alamat', 'value' => 'JL. AP. PETTARANI, MAKASSAR, SULAWESI SELATAN, MAKASSAR', 'icon' => 'location', 'urutan' => 1],
            ['type' => 'contact', 'label' => 'Email', 'value' => 'Myunm@gmail.com', 'url' => 'mailto:Myunm@gmail.com', 'icon' => 'email', 'urutan' => 2],
            ['type' => 'contact', 'label' => 'Telepon', 'value' => '088-1975-3103', 'url' => 'tel:08819753103', 'icon' => 'phone', 'urutan' => 3],
            ['type' => 'social', 'label' => 'YouTube', 'url' => '#', 'icon' => 'youtube', 'urutan' => 1],
            ['type' => 'social', 'label' => 'Instagram', 'url' => '#', 'icon' => 'instagram', 'urutan' => 2],
            ['type' => 'social', 'label' => 'Facebook', 'url' => '#', 'icon' => 'facebook', 'urutan' => 3],
            ['type' => 'social', 'label' => 'WhatsApp', 'url' => '#', 'icon' => 'whatsapp', 'urutan' => 4],
        ];

        foreach ($items as $item) {
            FooterItem::firstOrCreate(
                ['type' => $item['type'], 'label' => $item['label']],
                $item
            );
        }
    }
}
