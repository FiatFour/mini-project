<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;

class BlockSearch extends Component
{
    public $title;
    public $is_toggle;
    public $block_icon_class;
    public $block_header_class;
    public $block_content_class;

    public function __construct()
    {
        $this->title = __('lang.search');
        $this->is_toggle = true;
        $this->block_icon_class = 'icon-search';
        $this->block_header_class = null;
        $this->block_content_class = 'pt-0';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.blocks.block');
    }
}
