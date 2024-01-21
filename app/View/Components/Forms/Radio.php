<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Radio extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $label;
    public $label_class;
    public $input_class;
    public $value = 1;

    public function __construct($id, $label, $optionals = [], $value)
    {
        // dd($value);
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
        // $this->value = ($value == null) ? true : $value;
        // dd($value);
        $this->label_class = (isset($optionals['label_class']) ? $optionals['label_class'] : 'text-start col-form-label form-label');
        $this->input_class = (isset($optionals['input_class']) ? $optionals['input_class'] : 'col-sm-4');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.radio');
    }
}
