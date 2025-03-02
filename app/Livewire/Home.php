<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use function view;

class Home extends Component
{
    public $show = false;

    public $newTask = "";

    public function addTask()
    {
        $this->validate([
            'newTask' => 'required'
        ]);

        Todo::create([
            'task' => $this->newTask
        ]);

        $this->reset('newTask');
        $this->reset('show');
    }

    public function toggleTask(Todo $todo) 
    {
        $newStatus = !$todo->finished;

        $todo->update([
            'finished' => $newStatus,
        ]);
    }

    public function deleteTask(Todo $todo)
    {
        $todo->delete();
    }

    public function render()
    {
        return view('livewire.home', [
            'todos' => Todo::orderBy('finished')->get()
        ]);
    }
}
