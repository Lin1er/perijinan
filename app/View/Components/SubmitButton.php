<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    public $text;
    public $color;
    public $size;

    public function __construct($text = 'Submit', $color = 'blue', $size = 'md')
    {
        $this->text = $text;
        $this->color = $color;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.submit-button');
    }
}
