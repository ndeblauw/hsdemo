<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Todos extends Component
{
    public $todos = [];
    public $todo = '';
    public $user_id;

    public function mount( int $user_id)
    {
        // Initialize component
        $this->user_id = $user_id;

        // Fetch data from database for user with id $user_id
        $this->todos = [
            'buy milk',
            'go to the gym',
        ];
    }

    public function updatedTodo($value)
    {
        $this->todo = strtoupper($value);
    }

    public function delete($id)
    {
        // authorisation
        unset($this->todos[$id]);
    }

    public function addTodo()
    {
        // validation + authorisation
        $this->todos[] = $this->todo;
        $this->todo = '';

        $this->dispatch('myCrazyEvent', 'crazy');
    }

    public function render()
    {
        $user = User::find($this->user_id);

        return view('livewire.todos', [
            'user' => $user,
        ]);
    }
}
