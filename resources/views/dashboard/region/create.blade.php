<div class="row">
    <div class="col-xs-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label class="required" for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name') }}">
            @error('name')
                <span class="help-block">{{ $errors->first('name') }}</span>
            @enderror
        </div>
    </div>
</div>
