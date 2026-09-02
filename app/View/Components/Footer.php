<?php

namespace App\View\Components;

use App\Models\FooterItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.footer', [
            'contacts' => FooterItem::where('type', 'contact')->where('status', true)->orderBy('urutan')->get(),
            'socialLinks' => FooterItem::where('type', 'social')->where('status', true)->orderBy('urutan')->get(),
        ]);
    }
}
