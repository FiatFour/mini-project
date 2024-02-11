<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SelectOption2 extends Component
{
    public $id;
    public $list;
    public $label;
    public $value;
    public $label_class;
    public $input_class;
    public $select_option;
    public $required;
    public $select2;
    public $select_class;
    public $ajax;
    public $default_option_label;
    public $multiple;
    public $model;
    public $label_suffix;

    public function __construct($id, $list, $label, $value, $optionals = [])
    {
        $this->id = $id;
        $this->list = $list;
        $this->label = $label;
        $this->value = $value;
        $this->label_class = (isset($optionals['label_class']) ? $optionals['label_class'] : 'text-start  col-form-label');
        $this->input_class = (isset($optionals['input_class']) ? $optionals['input_class'] : 'col-sm-4');
        $this->select_option = (isset($optionals['select_option']) ? $optionals['select_option'] : false);
        $this->required = (isset($optionals['required']) ? $optionals['required'] : false);
        $this->select2 = (isset($optionals['select2']) ? $optionals['select2'] : true);
        $this->ajax = (isset($optionals['ajax']) ? $optionals['ajax'] : false);
        $this->multiple = (isset($optionals['multiple']) ? $optionals['multiple'] : false);
        $this->default_option_label = (isset($optionals['default_option_label']) ? $optionals['default_option_label'] : __('lang.select_option'));
        $this->model = (isset($optionals['model']) ? $optionals['model'] : false);
        $this->label_suffix = (isset($optionals['label_suffix']) ? $optionals['label_suffix'] : null);

        $this->select_class = 'form-control';
        if ($this->select2) {
            $this->select_class .= ' js-select2-default';
        }
        if (isset($optionals['select_class'])) {
            $this->select_class = 'form-control ' . $optionals['select_class'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select-option2');
    }
}
