<div class="grid place-content-center h-screen gap-4">
    <ul class="menu bg-base-200 rounded-box w-80">
        @forelse ($todos as $todo)
            <li>
                <div @class(['line-through' => $todo->finished])>
                    <div wire:click="toggleTask({{ $todo->id }})">
                        {{ $todo->task }}
                    </div>
                    <button class="badge badge-sm badge-error" wire:click="deleteTask({{ $todo->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
            </li>
        @empty
            <li>
                <p class="text-center">No task found</p>
            </li>
        @endforelse
    </ul>

    <!-- Open the modal using ID.showModal() method -->
    <button class="btn" wire:click="$set('show', true)">Create ToDo</button>

    <dialog class="modal" {{ $show ? 'open' : '' }} data-theme="light">
    <form class="modal-box" wire:submit="addTask">
        <h3 class="text-lg font-bold">Add New Task</h3>
        <div class="py-4">
            <div class="form-control w-full">
            <label class="label">
                <span class="label-text">What's task today ?</span>
            </label>
            <input type="text" placeholder="Type here" wire:model="newTask" 
                @class(['input input-bordered w-full', 
                'input-error' => $errors->has('newTask'),
            ])>
            @error('newTask') 
                <div class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </div>
            @enderror
            </div>
        </div>
        <div class="modal-action">
            <button type="button" class="btn" wire:click="$set('show', false)">Close</button>
            <button class="btn btn-primary">Add Task</button>
        </div>
    </form>
    </dialog>
</div>
