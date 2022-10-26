<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('firstname') ? 'has-error':'' }}">
        <label class="required" for="firstname">First Name</label>
        <input type="text" name="firstname" class="form-control" placeholder="" value="{{old('firstname') ?? $Teacher->firstname}}">
        @error('name')
         <span class="help-block">{{ $errors->first('firstname') }}</span>
        @enderror
      </div>
</div>

<div class="col-md-12">
    <div class="form-group {{ $errors->has('lastname') ? 'has-error':'' }}">
        <label class="required" for="lastname">Last Name</label>
        <input type="text" name="lastname" class="form-control" placeholder="" value="{{old('lastname') ?? $Teacher->lastname}}">
        @error('name')
         <span class="help-block">{{ $errors->first('lastname') }}</span>
        @enderror
      </div>
</div>


<div class="col-md-12">
    <div class="form-group {{ $errors->has('phonenumber') ? 'has-error':'' }}">
        <label class="required" for="phonenumber">Phone Number</label>
        <input type="text" name="phonenumber" class="form-control" placeholder="" value="{{old('phonenumber') ?? $Teacher->phonenumber}}">
        @error('phonenumber')
         <span class="help-block">{{ $errors->first('phonenumber') }}</span>
        @enderror
      </div>
</div>

<div class="col-md-12">
    <div class="form-group {{ $errors->has('email') ? 'has-error':'' }}">
        <label class="required" for="name">Email</label>
        <input type="email" name="email" class="form-control" placeholder="example@gmail.com" value="{{old('email') ?? $Teacher->email}}">
        @error('email')
         <span class="help-block">{{ $errors->first('email') }}</span>
        @enderror
      </div>
</div>

<!-- 
<div class="col-md-12">
     <div class="form-group {{ $errors->has('gender') ? 'has-error':'' }}">
        <label class="required">Gender</label>
           <select class="form-control select2" name="gender" style="width: 100%;">
            <option value="">--Select Gender--</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
             
        </select>
      </div>
</div> -->

 <div class="col-md-12">
     <div class="form-group {{ $errors->has('role_id') ? 'has-error':'' }}">
        <label class="required">Role</label>
           <select class="form-control select2" name="role_id" style="width: 100%;">
            <option value="">--Select Role--</option>
              @foreach ($roles as $role)
                  <option value="{{$role->id}}" {{$Teacher->id == $role->id ? 'selected':''}}>{{$role->name}}</option>
              @endforeach
        </select>
      </div>
</div>


<div class="col-md-12">
     <div class="form-group {{ $errors->has('school_id') ? 'has-error':'' }}">
        <label class="required">School</label>
           <select class="form-control select2" name="school_id" style="width: 100%;">
            <option value="">--Select School--</option>
              @foreach ($schools as $school)
                  <option value="{{$school->id}}">{{$school->name}} {{$school->educationLevel}}</option>
              @endforeach
        </select>
      </div>
</div>

</div>
