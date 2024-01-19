<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class HelloWorld extends Component
{
    public $crazy = false;

    #[On('myCrazyEvent')]
    public function doThisWhenCrazynessArrives($crazy)
    {
        $this->crazy = true;
    }

    public function render()
    {
        return view('livewire.hello-world');
    }
}
