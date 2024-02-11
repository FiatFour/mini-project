<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;

class BlockTable extends Component
{
    public $title;
    public $is_toggle;
    public $block_icon_class;
    public $block_header_class;
    public $block_content_class;

    public function __construct()
    {
        $this->title = __('lang.total_list');
        $this->is_toggle = false;
        $this->block_icon_class = 'icon-document';
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
