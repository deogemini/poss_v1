
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                <label class="required" for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name') ?? $ward->name}}" placeholder="">
                @error('name')
                 <span class="help-block">{{ $errors->first('name') }}</span>
                @enderror
              </div>
        </div>


         <div class="col-md-12">
             <div class="form-group {{ $errors->has('education_level_id') ? 'has-error':'' }}">
                <label class="required">Region</label>
                   <select class="form-control select2" name="education_level_id" id="education_level_select_edit" style="width: 100%;">
                    <option value="">--Select Region--</option>
                      @foreach ($regions as $region)
                          <option value="{{$region->id}}" {{$ward->district->region->id == $region->id ? 'selected':''}}>{{$region->name}}</option>
                      @endforeach
                </select>
                 @error('region_id')
                   <span class="help-block">{{ $errors->first('region_id') }}</span>
                 @enderror
              </div>
        </div>


         <div class="col-md-12">
             <div class="form-group {{ $errors->has('district_id') ? 'has-error':'' }}">
                <label class="required">District</label>
                   <select class="form-control select2" name="district_id" style="width: 100%;">
                    <option value="">--Select District--</option>
                      @foreach ($districts as $district)
                          <option value="{{$district->id}}" {{$ward->district->id == $district->id ? 'selected':''}}>{{$district->name}}</option>
                      @endforeach
                    </select>
                 @error('district_id')
                   <span class="help-block">{{ $errors->first('district_id') }}</span>
                 @enderror
              </div>
        </div>

    </div>
