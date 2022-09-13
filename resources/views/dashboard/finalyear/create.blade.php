<div class="row">

<div class="col-md-12">
    <div class="form-group {{ $errors->has('year') ? 'has-error':'' }}">
        <label class="required" for="name">Year</label>
        <input type="text" name="year" class="form-control" placeholder="" value="{{old('year')}}">
        @error('year')
         <span class="help-block">{{ $errors->first('year') }}</span>
        @enderror
      </div>
</div>

</div>