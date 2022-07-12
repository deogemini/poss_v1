
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                <label class="required" for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name') ?? $school->name}}" placeholder="">
                @error('name')
                 <span class="help-block">{{ $errors->first('name') }}</span>
                @enderror
              </div>
        </div>


         <div class="col-md-12">
             <div class="form-group {{ $errors->has('ward_id') ? 'has-error':'' }}">
                <label class="required">Ward</label>
                   <select class="form-control select2" name="district_id" style="width: 100%;">
                    <option value="">--Select Ward--</option>
                      @foreach ($wards as $ward)
                          <option value="{{$ward->id}}" {{$school->ward->id == $ward->id ? 'selected':''}}>{{$ward->name}}</option>
                      @endforeach
                    </select>
                 @error('ward_id')
                   <span class="help-block">{{ $errors->first('ward_id') }}</span>
                 @enderror
              </div>
        </div>

    </div>
