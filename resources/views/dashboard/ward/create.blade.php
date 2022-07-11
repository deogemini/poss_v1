<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
        <label class="required" for="name"> Ward Name</label>
        <input type="text" name="name" class="form-control" value="{{old('name') ?? $ward->name}}" placeholder="">
        @error('name')
         <span class="help-block">{{ $errors->first('name') }}</span>
        @enderror
      </div>
</div>

<div class="col-md-12">
     <div class="form-group {{ $errors->has('district_id') ? 'has-error':'' }}">
        <label class="required">District</label>
           <select class="form-control select2" name="district_id" style="width: 100%;">
            <option value="">---Select District</option>
              @foreach ($districts as $district)
                  <option value="{{$district->id}}">{{$district->name}}</option>
              @endforeach
        </select>
        @error('district_id')
        <span class="help-block">{{ $errors->first('district')}}</span>
        @enderror
      </div>
</div>


</div>