<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\View\Component;
use Symfony\Component\Routing\Annotation\Route;

class nav extends Component
{

    public $items;
    public $active;
    /**
     *
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = config('nav');
        $this->active = FacadesRoute::currentRouteName();


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav');
    }
}
