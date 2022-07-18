<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
        <label class="required" for="name"> Stream Name</label>
        <input type="text" name="name" class="form-control" value="{{old('name') ?? $stream->name}}" placeholder="">
        @error('name')
         <span class="help-block">{{ $errors->first('name') }}</span>
        @enderror
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
             <div class="form-group {{ $errors->has('grade_id') ? 'has-error':'' }} d-none" id="grade">
                <label class="required">Grade</label>
                   <select class="form-control" id="grade_id" name="grade_id" style="width: 100%;">
                    <option value="">--Select Grade--</option>  
                      </select>
                 @error('grade_id')
                   <span class="help-block">{{ $errors->first('grade_id') }}</span>
                 @enderror
              </div>
        </div>


</div>