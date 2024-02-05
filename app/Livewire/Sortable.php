<?php

namespace App\Livewire;

use App\Models\tasks;
use Livewire\Component;

class Sortable extends Component
{
    public $newTaskTitle;


    public function render()
    {
        $tasks = tasks::orderBy('order')
            ->get(['id', 'title', 'order']);

        return view('livewire.sortable', [
            'tasks' => $tasks
        ]);
    }

    function updateTaskOrder($tasks)
    {
        foreach ($tasks as $task) {
            tasks::find($task['value'])
                ->update(['order' => $task['order']]);
        }
    }

    function removeTask($taskId)
    {
        tasks::find($taskId)
            ->delete();
    }

    function addTask()
    {
        tasks::create([
            'title' => $this->newTaskTitle,
            'order' => tasks::count() + 1
        ]);
    }
}
