<div class="fixed top-20 right-4 w-80 bg-white shadow-lg rounded-xl p-4">
    <h4 class="font-semibold mb-2">📋 تسک‌های امروز</h4>
    <ul>
        @foreach($tasks as $task)
        <li class="flex items-center justify-between mb-1">
            <label class="flex-1 cursor-pointer {{ $task->completed ? 'line-through text-gray-400' : '' }}">
                <input type="checkbox" class="task-checkbox" data-id="{{ $task->id }}" {{ $task->completed ? 'checked' : '' }}>
                {{ $task->title }}
            </label>
        </li>
        @endforeach
    </ul>
</div>

<script>
document.querySelectorAll('.task-checkbox').forEach(el => {
    el.addEventListener('change', function(){
        let taskId = this.dataset.id;
        fetch('/tasks/' + taskId + '/complete', {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(res => res.json()).then(data => {
            if(data.success){
                if(data.completed){
                    this.parentElement.classList.add('line-through','text-gray-400');
                } else {
                    this.parentElement.classList.remove('line-through','text-gray-400');
                }
            }
        });
    });
});
</script>
