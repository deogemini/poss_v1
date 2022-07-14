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
     <div class="form-group {{ $errors->has('grade_id') ? 'has-error':'' }}">
        <label class="required">Grade</label>
           <select class="form-control select2" name="school_id" style="width: 100%;">
            <option value="">---Select Grade---</option>
              @foreach ($grades as $grade)
                  <option value="{{$grade->id}}">{{$grade->name}}</option>
              @endforeach
        </select>
        @error('grade_id')
        <span class="help-block">{{ $errors->first('grade_id')}}</span>
        @enderror
      </div>
</div>


</div>