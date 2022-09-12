<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('student_name') ? 'has-error':'' }}">
        <label class="required" for="student_name">Full Student Name</label>
        <input type="text" name="student_name" class="form-control" placeholder="" value="{{old('student_name')}}" required>
        @error('student_name')
         <span class="help-block">{{ $errors->first('student_name') }}</span>
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
     <div class="form-group {{ $errors->has('school_id') ? 'has-error':'' }}">
        <label class="required">School</label>
           <select class="form-control select2" id="school_id"  name="school_id" style="width: 100%;">
            <option value="">--Select School--</option>
              @foreach ($schools as $school)
                  <option value="{{$school->id}}">{{$school->name}} {{$school->educationLevel}}</option>
              @endforeach
        </select>
      </div>
</div>

<div class="col-md-12">
     <div class="form-group {{ $errors->has('stream_id') ? 'has-error':'' }}">
        <label class="required">Stream</label>
           <select class="form-control select2" id="stream_id"  name="stream_id" style="width: 100%;">
            <option value="">--Select Stream--</option>
              @foreach ($streams as $stream)
                  <option value="{{$stream->id}}">{{$stream->name}}</option>
              @endforeach
        </select>
      </div>
</div>


<div class="col-md-12">
             <div class="form-group {{ $errors->has('stream_id') ? 'has-error':'' }} d-none" id="stream">
                <label class="required">Finishing Year</label>
                   <select class="form-control" id="stream_id" name="stream_id" style="width: 100%;">
                    <option value="">--Select Finishing Year--</option>   
                    </select>
                 @error('stream_id')
                   <span class="help-block">{{ $errors->first('stream_id') }}</span>
                 @enderror
              </div>
        </div>
</div>


  