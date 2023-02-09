<div  id="edit-error" style="display: none"></div>

<form id="edit-vendor-form">

   <input type="hidden" name="room_id" value="{{$manageRoom->id}}">

    <div>
        <div class="form-group mb-5">

            <select onchange="geteditRoomsDetail({{$manageRoom->property_id}})" id="floorNo" class="form-control" name="floor">

                <option value="">Select Floor</option>
                @for($i=1;$i<=$property->floors;$i++)


                    <option  value="{{$i}}"  @if($manageRoom->floor==$i) selected @endif>{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>;

                @endfor




            </select>
        </div>



        <div id="showRoomsedit" >


        <div class="form-group mb-5">

            <select  class="form-control" id="room" name="room">

                <option value="">Select Room</option>
                @for($i=1;$i<=$roomInfo->rooms;$i++)


               <option value="{{$i}}"  @if($manageRoom->room==$i) selected @endif>{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>;

                @endfor




            </select>
        </div></div>
      </div>

    <div class="form-group mb-5" style="" id="users">

        <select class="form-control" id="staff" name="user">

            <option value="">Select Staff Member</option>

             @foreach($users as $u)
                <option value="{{$u->user_id}}" @if($manageRoom->assign_to==$u->user_id) selected @endif>{{$u->first_name}}</option>
            @endforeach


        </select>
    </div>

    <div id="mainTask" >
        <div class="custom-control custom-checkbox">
        <?php $rouCheck=0; ?>
        @foreach($tasks as $task)
            @if($task->id==14)

                <?php $rouCheck=1; ?>

            @endif

        @endforeach


        @if($rouCheck==1)
            <input type="checkbox" name="clean" value="14" class="custom-control-input" id="defaultUncheckededit" checked>
            <label class="custom-control-label" for="defaultUncheckededit">Routine Clean Complete</label>

        @else
            <input type="checkbox" name="clean" value="14" class="custom-control-input" id="defaultUncheckededit">
            <label class="custom-control-label" for="defaultUncheckededit">Routine Clean Complete</label>

        @endif
        </div>

            @if(count($tasks)>0)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox"  class="custom-control-input" id="defaultUnchecked123" checked>
                    <label class="custom-control-label" for="defaultUnchecked123">Special Clean</label>
                </div>

                @else
                <div class="custom-control custom-checkbox">
                    <input type="checkbox"  class="custom-control-input" id="defaultUnchecked123" >
                    <label class="custom-control-label" for="defaultUnchecked123">Special Clean</label>
                </div>

            @endif
    </div>

    <div id="specialTask">
        <ul class="list-group list-group-flush">

            @foreach($roomTask as $rt)
                <?php $check=0 ?>
                @foreach($tasks as $t)
                    @if($rt->id==$t->id)
                       <?php $check=1?>
                        @endif

                @endforeach

                <li class="list-group-item">
                    <!-- Default checked -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="task[]" value="{{$rt->id}}" class="custom-control-input" id="checks{{$rt->id}}" @if($check==1) checked @endif >
                        <label class="custom-control-label" for="checks{{$rt->id}}">{{ucfirst($rt->name)}}</label>
                    </div>
                </li>

            @endforeach

        </ul>
    </div>








</form>
<input type="hidden" name="roomId" id="roomId" value="{{$manageRoom->room}}">
<input type="hidden" name="floorId" id="floorId" value="{{$manageRoom->floor}}">
