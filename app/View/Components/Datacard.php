<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Datacard extends Component
{
    public $title;
    public $icon;
    public $color;
    public $more;

    public function __construct($title, $icon, $color, $more)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->color = $color;
        $this->more = $more;
    }

    public function render()
    {
        return view('components.datacard');
    }
}
