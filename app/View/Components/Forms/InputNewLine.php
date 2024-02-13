<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isTrue;

class InputNewLine extends Component
{
    public $id;
    public $value;
    public $label;
    public $type;
    public $placeholder;
    public $maxlength;
    public $min;
    public $oninput;
    public $required;
    public $label_class;
    public $input_class;
    public $prefix;
    public $suffix;
    public $readonly;
    public $label_suffix;

    public function __construct($id, $value, $label, $optionals = [])
    {
        $this->id = $id;
        $this->value = $value;
        $this->label = $label;
        $this->type = (isset($optionals['type']) ? $optionals['type'] : 'text');
        $this->placeholder = (isset($optionals['placeholder']) ? $optionals['placeholder'] : '');
        $this->maxlength = (isset($optionals['maxlength']) ? $optionals['maxlength'] : 100);
        $this->min = (isset($optionals['min']) ? $optionals['min'] : 1);
        $this->oninput = (isset($optionals['oninput']) ? "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" : '');
        $this->required = (isset($optionals['required']) ? $optionals['required'] : false);
        $this->label_class = (isset($optionals['label_class']) ? $optionals['label_class'] : 'text-start col-form-label');
        $this->input_class = (isset($optionals['input_class']) ? $optionals['input_class'] : 'col-sm-4');
        $this->prefix = (isset($optionals['prefix']) ? $optionals['prefix'] : false);
        $this->suffix = (isset($optionals['suffix']) ? $optionals['suffix'] : false);
        $this->readonly = (isset($optionals['readonly']) ? $optionals['readonly'] : false);
        $this->label_suffix = (isset($optionals['label_suffix']) ? $optionals['label_suffix'] : null);
    }

    public function render()
    {
        if ($this->prefix || $this->suffix) {
            return view('components.forms.input-group');
        }
        return view('components.forms.input-new-line');
    }
}
