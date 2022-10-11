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
</div>