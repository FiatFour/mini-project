<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;

class TitleHeader extends Component
{
    public $text;
    public $icon;
    public $class;
    public $noline;

    public function __construct($text = null, $icon = null, $class = null, $noline = null)
    {
        $this->text = $text;
        $this->icon = $icon;
        $this->class = $class;
        $this->noline = $noline;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.blocks.title-header');
    }
}
