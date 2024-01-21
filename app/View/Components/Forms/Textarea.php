<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $value = null;
    public $label;
    public $label_class;
    public $textarea_class;
    public $placeholder;

    public function __construct($id, $label, $optionals = [], $value)
    {
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
        $this->label_class = (isset($optionals['form-label']) ? $optionals['form-label'] : 'text-start col-form-label');
        $this->textarea_class = (isset($optionals['textarea_class']) ? $optionals['textarea_class'] : 'form-control');
        $this->placeholder = (isset($optionals['placeholder']) ? $optionals['placeholder'] : 'Choose one..');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.textarea');
    }
}
