<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public int $counter = 42;
    public bool $show_counter = true;
    public int $amount = 1;

    public function showCounter()
    {
        $this->show_counter = true;
    }

    public function increment()
    {
        $this->counter += $this->amount;
    }

    public function decrement()
    {
        $this->counter -=  $this->amount;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
