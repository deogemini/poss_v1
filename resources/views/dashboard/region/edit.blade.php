<div class="row">
        <div class="col-xs-6">
            <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                <label class="required" for="name">Region Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name') ?? $region->name}}" placeholder="">
                @error('name')
                 <span class="help-block">{{ $errors->first('name') }}</span>
                @enderror
              </div>
        </div>

    </div>