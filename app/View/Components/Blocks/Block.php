<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;

class Block extends Component
{
    public $id;
    public $title;
    public $is_toggle;
    public $block_icon_class;
    public $block_header_class;
    public $block_content_class;

    public function __construct($id = null, $title = null, $optionals = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->is_toggle = isset($optionals['is_toggle']) ? boolval($optionals['is_toggle']) : true;
        $this->block_icon_class = isset($optionals['block_icon_class']) ? $optionals['block_icon_class'] : 'icon-document';
        $this->block_header_class = isset($optionals['block_header_class']) ? $optionals['block_header_class'] : null;
        $this->block_content_class = isset($optionals['block_content_class']) ? $optionals['block_content_class'] : null;
        if (empty($this->block_content_class) && (!empty($this->title))) {
            $this->block_content_class = 'pt-0';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.block');
    }
}
