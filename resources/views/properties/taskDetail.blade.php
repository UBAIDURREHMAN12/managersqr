
<div class="custom-control custom-checkbox">
    @foreach($tasks as $task)
        @if($task->id==14)

        <input type="checkbox" name="clean" value="14" class="custom-control-input" id="defaultUnchecked" checked>
    <label class="custom-control-label" for="defaultUnchecked">Routine Clean Complete</label>
        @endif

    @endforeach
</div>

@if(count($tasks)>0)
<div class="custom-control custom-checkbox">
    <input type="checkbox" onchange="showTask('specialTask')" class="custom-control-input" id="defaultUnchecked1" checked>
    <label class="custom-control-label" for="defaultUnchecked1">Special Clean</label>
</div>
@endif
<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <!-- Default checked -->

        @foreach($tasks as $task)
            @if($task->id!=14)
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" value="{{$task->id}}" id="check{{$task->id}}" checked>
            <label class="custom-control-label" for="check{{$task->id}}">{{$task->name}}</label>
        </div>
            @endif
            @endforeach
    </li>

</ul>
