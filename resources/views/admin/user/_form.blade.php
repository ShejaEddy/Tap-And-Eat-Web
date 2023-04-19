@csrf
@if(session("success"))
    <div class="mt-4 ml-4 mr-4 alert alert-success">
        {{ session("success") }}
    </div>
@endif
@if ($errors->any())
    <div class="mt-4 ml-4 mr-4 alert alert-default-danger">
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    </div>
@endif
<div class="card-body">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name',$user->name) }}"
               placeholder="Enter name"
               required>
    </div>
    <div class="form-group">
        <label for="email=">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ old('email',$user->email) }}"
               placeholder="Enter email"
               required>
    </div>
    <div class="form-group">
        <label for="role=">Role</label>
        <select name="role" id="role" class="form-control">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
        </select>

    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $btnText }}</button>
</div>
