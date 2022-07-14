<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
        <label class="required" for="name"> Grade Name</label>
        <input type="text" name="name" class="form-control" value="{{old('name') ?? $grade->name}}" placeholder="">
        @error('name')
         <span class="help-block">{{ $errors->first('name') }}</span>
        @enderror
      </div>
</div>

<div class="col-md-12">
     <div class="form-group {{ $errors->has('school_id') ? 'has-error':'' }}">
        <label class="required">School</label>
           <select class="form-control select2" name="school_id" style="width: 100%;">
            <option value="">---Select School---</option>
              @foreach ($schools as $school)
                  <option value="{{$school->id}}">{{$school->name}}</option>
              @endforeach
        </select>
        @error('school_id')
        <span class="help-block">{{ $errors->first('school_id')}}</span>
        @enderror
      </div>
</div>


</div>