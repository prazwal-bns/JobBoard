<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Label extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $for = '',
        public ?bool $required = false
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.label');
    }
}
