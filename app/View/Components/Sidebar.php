<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $currentLink = Request::path();
        $links = [
            [
                'title' => 'Note',
                'path' => '/',
                'icon' => 'notes',
            ],
            [
                'title' => 'Archive',
                'path' => 'archive',
                'icon' => 'inbox',
            ],
            [
                'title' => 'Settings',
                'path' => 'settings',
                'icon' => 'settings',
            ],
        ];
        
        return view('components.sidebar', [
            'user' => Auth::user(),
            'currentLink' => $currentLink,
            'links' => $links,
        ]);
    }
}
