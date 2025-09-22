<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionTitle extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $title,public $subtitle)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.section-title');
    }
}
