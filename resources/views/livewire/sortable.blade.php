<div>
    <form wire:submit.prevent>
        <input wire:model='newTaskTitle'>
        <button wire:click='addTask'>add</button>
    </form>
    <div>
        <ul wire:sortable="updateTaskOrder">
            @foreach ($tasks as $task)
            <li wire:sortable.item="{{ $task['id'] }}" wire:key="task-{{ $task['id'] }}"
                class="bg-gray-100 rounded-full flex w-40 items-center justify-around m-1 shadow-lg border border-gray-300 font-bold text-gray-500">
                <h4 wire:sortable.handle class="cursor-move">{{ $task['title'] }}</h4>
                <button wire:click="removeTask({{ $task['id'] }})"
                    class="rounded-full border-2 border-red-400 shadow-lg text-red-400  px-1 text-xs">X</button>
            </li>
            @endforeach
        </ul>
    </div>
    <pre class="text-xs">
        {!!json_encode($tasks,JSON_PRETTY_PRINT)!!}
    </pre>
</div>
