<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class FormCheckboxes extends Component
{
    public function __construct(
        public string $label,
        public string $name,
        public Collection|array $options,
        public Collection|array $values = [],
    ) {
        // Assure that both options and values are collections
        $this->options = (gettype($this->options) === 'array') ? collect($this->options) : $this->options;
        $this->values = (gettype($this->values) === 'array') ? collect($this->values) : $this->values;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-checkboxes');
    }
}
