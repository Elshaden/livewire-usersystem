<?php

namespace Elshaden\LivewireUsersystem\resources\ViewComponents;

use Illuminate\View\Component;

class Ummaster extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('livewire-usersystem::components.ummaster');
    }
}
