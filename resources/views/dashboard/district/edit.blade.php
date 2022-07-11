<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
        <label class="required" for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{old('name') ?? $district->name}}" placeholder="">
        @error('name')
         <span class="help-block">{{ $errors->first('name') }}</span>
        @enderror
      </div>
</div>

<div class="col-md-12">
     <div class="form-group {{ $errors->has('education_level_id') ? 'has-error':'' }}">
        <label class="required">Region</label>
           <select class="form-control select2" name="region_id" style="width: 100%;">
            <option value=""></option>
              @foreach ($regions as $region)
                  <option value="{{$region->id}}" {{$district->id == $region->id ? 'selected':''}}>{{$region->name}}</option>
              @endforeach
        </select>
      </div>
</div>

</div>