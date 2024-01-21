<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectStatus extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    // public $value;
    public $label;
    public $label_class;
    public $select_class;
    public $type;
    public $placeholder;
    public $selected;

    public function __construct($id, $label, $optionals = [], $selected)
    {
        $this->id = $id;
        $this->selected = $selected;
        // $this->value = $value;
        $this->label = $label;
        $this->label_class = (isset($optionals['form_label']) ? $optionals['form_label'] : 'text-start col-form-label');
        $this->select_class = (isset($optionals['select_class']) ? $optionals['select_class'] : 'form-select');
        // $this->type = (isset($optionals['type']) ? $optionals['type'] : 'text');
        $this->placeholder = (isset($optionals['placeholder']) ? $optionals['placeholder'] : 'Choose one..');
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select-status');
    }
}
