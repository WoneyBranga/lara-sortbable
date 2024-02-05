<?php

namespace App\Livewire;

use Livewire\Component;

class SortableSession extends Component
{
    public $newTaskTitle;

    public $localTasks = [
        ['id' => 1, 'order' => 1, 'title' => 'Task 1'],
        ['id' => 2, 'order' => 2, 'title' => 'Task 2'],
    ];

    public function render()
    {
        if (session()->has('tasks')) {
            $this->localTasks = session()->get('tasks');
        }
        return view('livewire.sortable-session', ['tasks' => $this->localTasks]);
    }

    function updateTaskOrder($tasks)
    {
        foreach ($tasks as $task) {
            $this->localTasks = collect($this->localTasks)
                ->map(function ($item) use ($task) {
                    if ($item['id'] == $task['value']) {
                        $item['order'] = $task['order'];
                    }
                    return $item;
                })
                ->sortBy('order')
                ->values()
                ->all();
        }

        $this->localTasks = collect($this->localTasks)
            ->map(function ($item, $index) {
                $item['order'] = $index + 1;
                return $item;
            });

        session()->put('tasks', $this->localTasks);
    }

    function removeTask($taskId)
    {
        $this->localTasks = collect($this->localTasks)
            ->reject(function ($item) use ($taskId) {
                return $item['id'] === $taskId;
            })
            ->values()
            ->all();

        $this->localTasks = collect($this->localTasks)
            ->map(function ($item, $index) {
                $item['order'] = $index + 1;
                return $item;
            });

        session()->put('tasks', $this->localTasks);
    }

    function addTask()
    {
        $this->localTasks[] = [
            // 'id' => count($this->localTasks) + 1, // precisamos ver na lista o maior id corrente para entao adicionar +1
            'id' => collect($this->localTasks)->max(fn ($item) => $item['id']) + 1, // outra forma de pegar o maior id
            'order' => count($this->localTasks) + 1,
            'title' => $this->newTaskTitle
        ];

        $this->localTasks = collect($this->localTasks)
            ->map(function ($item, $index) {
                $item['order'] = $index + 1;
                return $item;
            });

        session()->put('tasks', $this->localTasks);
    }
}
