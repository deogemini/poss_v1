<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
        <label class="required" for="name">Name</label>
        <input type="text" name="name" class="form-control" placeholder="" value="{{old('name')}}">
        @error('name')
         <span class="help-block">{{ $errors->first('name') }}</span>
        @enderror
      </div>
</div>

 <div class="col-md-12">
     <div class="form-group {{ $errors->has('region_id') ? 'has-error':'' }}">
        <label class="required">Region</label>
           <select class="form-control select2" name="region_id" style="width: 100%;">
            <option value="">--Select Region--</option>
              @foreach ($regions as $region)
                  <option value="{{$region->id}}">{{$region->name}}</option>
              @endforeach
        </select>
      </div>
</div>

</div>