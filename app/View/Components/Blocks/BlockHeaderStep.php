<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;

class BlockHeaderStep extends Component
{
    public $title;
    public $is_toggle;
    public $block_icon_class;
    public $block_header_class;
    public $block_content_class;
    public $step;
    public $total;
    public $success;
    public $step_text;
    public $showstep;

    public function __construct($title = null, $step = 1, $total = 7, $success = false, $optionals = [])
    {
        $this->title = $title;
        $this->step = $step;
        $this->total = $total;
        $this->success = $success;
        $this->is_toggle = isset($optionals['is_toggle']) ? $optionals['is_toggle'] : false;
        $this->block_icon_class = isset($optionals['block_icon_class']) ? $optionals['block_icon_class'] : false;
        $this->block_header_class = null;
        $this->block_content_class = 'pt-0';
        $this->showstep = isset($optionals['showstep']) ? $optionals['showstep'] : true;

        $this->step_text = 'ขั้นตอนที่ ' . $step . '/' . $total;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.blocks.block-header-step');
    }
}
