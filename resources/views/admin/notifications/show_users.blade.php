
<select name="users[]" class="multi-select" multiple="" id="my_multi_select3" >
    @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
</select>
