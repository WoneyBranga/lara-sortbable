<div>
    <form wire:submit.prevent>
        <input wire:model='newTaskTitle' class="rounded-lg h-7 shadow-md w-40 m-1">
        <button wire:click='addTask'
            class="bg-gray-300 border border-gray-700 rounded-lg w-24 shadow-lg font-bold text-gray-700">Adicionar</button>
    </form>
    <div>
        <ul wire:sortable="updateTaskOrder">
            @foreach ($tasks as $task)
            <li wire:sortable.item="{{ $task['id'] }}" wire:key="task-{{ $task['id'] }}"
                class="bg-gray-50 rounded-lg flex w-40 items-center justify-between px-3 m-1 shadow-md border border-gray-400 font-bold text-gray-500 hover:bg-gray-200">
                <h4 wire:sortable.handle class="cursor-move w-32">{{ $task['title'] }}</h4>
                <button wire:click="removeTask({{ $task['id'] }})"
                    class="rounded-full font-bold bg-red-400 shadow-lg text-red-200  px-1 text-xs hover:bg-red-600">X</button>
            </li>
            @endforeach
        </ul>
    </div>
    {{--
    <pre class="text-xs font-mono">
        {!!json_encode($localTasks,JSON_PRETTY_PRINT)!!}
    </pre> --}}
</div>
