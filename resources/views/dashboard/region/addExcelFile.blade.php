<div class="row">
    <div class="col-xs-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label class="required" for="name">Upload Excel File</label>
            <input type="file" name="name" class="form-control" placeholder="" value="{{ old('name') }}">
        </div>
    </div>
</div>
