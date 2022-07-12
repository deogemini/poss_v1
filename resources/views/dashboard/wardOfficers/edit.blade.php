<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('firstname') ? 'has-error':'' }}">
        <label class="required" for="firstname">First Name</label>
        <input type="text" name="firstname" class="form-control" placeholder="" value="{{old('firstname') ?? $wardOfficer->firstname}}">
        @error('name')
         <span class="help-block">{{ $errors->first('firstname') }}</span>
        @enderror
      </div>
</div>

<div class="col-md-12">
    <div class="form-group {{ $errors->has('lastname') ? 'has-error':'' }}">
        <label class="required" for="lastname">Last Name</label>
        <input type="text" name="lastname" class="form-control" placeholder="" value="{{old('lastname') ?? $wardOfficer->lastname}}">
        @error('name')
         <span class="help-block">{{ $errors->first('lastname') }}</span>
        @enderror
      </div>
</div>

<div class="col-md-12">
    <div class="form-group {{ $errors->has('email') ? 'has-error':'' }}">
        <label class="required" for="name">Email</label>
        <input type="email" name="name" class="form-control" placeholder="example@gmail.com" value="{{old('email') ?? $wardOfficer->email}}">
        @error('email')
         <span class="help-block">{{ $errors->first('email') }}</span>
        @enderror
      </div>
</div>


<div class="col-md-12">
     <div class="form-group {{ $errors->has('gender') ? 'has-error':'' }}">
        <label class="required">Gender</label>
           <select class="form-control select2" name="gender" style="width: 100%;">
            <option value="">--Select Gender--</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
             
        </select>
      </div>
</div>

 <div class="col-md-12">
     <div class="form-group {{ $errors->has('role_id') ? 'has-error':'' }}">
        <label class="required">Role</label>
           <select class="form-control select2" name="role_id" style="width: 100%;">
            <option value="">--Select Role--</option>
              @foreach ($roles as $role)
                  <option value="{{$role->id}}" {{$wardOfficer->id == $role->id ? 'selected':''}}>{{$role->name}}</option>
              @endforeach
        </select>
      </div>
</div>


<div class="col-md-12">
     <div class="form-group {{ $errors->has('ward_id') ? 'has-error':'' }}">
        <label class="required">Ward</label>
           <select class="form-control select2" name="ward_id" style="width: 100%;">
            <option value="">--Select Ward--</option>
              @foreach ($wards as $wards)
                  <option value="{{$ward->id}}">{{$ward->name}}</option>
              @endforeach
        </select>
      </div>
</div>

</div>
