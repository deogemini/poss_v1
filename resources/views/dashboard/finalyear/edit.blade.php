<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('year') ? 'has-error':'' }}">
        <label class="required" for="year">year</label>
        <input type="text" name="year" class="form-control" value="{{old('name') ?? $finalYear->year}}" placeholder="">
        @error('year')
         <span class="help-block">{{ $errors->first('year') }}</span>
        @enderror
      </div>
</div>
</div>