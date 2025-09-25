<?php

namespace App\View\Components\shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class _locale extends Component
{
    /**
     * Create a new component instance.
     */
 
    public $lang; 

    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared._locale');
    }
}
