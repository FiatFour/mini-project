<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $value;
    public $label;
    public $label_class;
    public $select_class;
    public $type;
    public $placeholder;
    public $items;
    public $selected;
    public $name;

    public function __construct($id, $label, $optionals = [], $items, $selected, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->selected = $selected;
        $this->label = $label;
        $this->items = $items;
        $this->label_class = (isset($optionals['form-label']) ? $optionals['form-label'] : 'text-start col-form-label');
        $this->select_class = (isset($optionals['select_class']) ? $optionals['select_class'] : 'js-select2');
        // $this->type = (isset($optionals['type']) ? $optionals['type'] : 'text');
        $this->placeholder = (isset($optionals['placeholder']) ? $optionals['placeholder'] : 'Choose one..');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
