<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Date extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $value;
    public $label;
    public $label_class;
    public $input_class;
    public $type;
    public $placeholder;

    public function __construct($id, $value, $label, $optionals = [])
    {
        $this->id = $id;
        $this->value = $value;
        $this->label = $label;
        $this->label_class = (isset($optionals['label_class']) ? $optionals['label_class'] : 'text-start col-form-label');
        $this->input_class = (isset($optionals['input_class']) ? $optionals['input_class'] : 'col-sm-4');
        $this->type = (isset($optionals['type']) ? $optionals['type'] : 'text');
        $this->placeholder = (isset($optionals['placeholder']) ? $optionals['placeholder'] : 'Y-m-d');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.date');
    }
}
