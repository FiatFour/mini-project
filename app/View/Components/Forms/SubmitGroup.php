<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SubmitGroup extends Component
{
    public $input_class;
    public $url;
    public $fullurl;
    public $status;
    public $manage_permission;
    public $input_class_submit;
    public $isdraft;
    public $btn_name;
    public $btn_draft_name;
    public $data_status;
    public $icon_class_name;
    public $icon_draft_class_name;

    public function __construct($optionals = [])
    {
        $this->input_class = (isset($optionals['input_class']) ? $optionals['input_class'] : 'text-end');
        $this->url = (isset($optionals['url']) ? $optionals['url'] : null);
        $this->fullurl = (isset($optionals['fullurl']) ? $optionals['fullurl'] : null);
        $this->status = (isset($optionals['view']) ? $optionals['view'] : null);
        $this->manage_permission = (isset($optionals['manage_permission']) ? $optionals['manage_permission'] : null);
        $this->input_class_submit = (isset($optionals['input_class_submit']) ? $optionals['input_class_submit'] : 'btn-save-form');
        $this->isdraft = (isset($optionals['isdraft']) ? $optionals['isdraft'] : false);
        $this->btn_name = (isset($optionals['btn_name']) ? $optionals['btn_name'] : __('lang.save'));
        $this->btn_draft_name = (isset($optionals['btn_draft_name']) ? $optionals['btn_draft_name'] : __('lang.save_draft'));
        $this->data_status = (isset($optionals['data_status']) ? $optionals['data_status'] : null);
        $this->icon_class_name = (isset($optionals['icon_class_name']) ? $optionals['icon_class_name'] : 'icon-save');
        $this->icon_draft_class_name = (isset($optionals['icon_draft_class_name']) ? $optionals['icon_draft_class_name'] : 'icon-save');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.submit-group');
    }
}
