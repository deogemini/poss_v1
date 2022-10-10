<div class="row">

<div class="col-md-12">
     <div class="form-group {{ $errors->has('teacher_id') ? 'has-error':'' }}">
        <label class="required">Teachers</label>
           <select class="form-control select2" name="teacher_id" style="width: 100%;">
            <option value="">--Select Teacher--</option>
              @foreach ($teachers as $teacher)
                  <option value="{{$teacher->id}}">{{$teacher->name}}</option>
              @endforeach
        </select>
      </div>
</div>

<div class="col-md-12">
     <div class="form-group {{ $errors->has('grade_id') ? 'has-error':'' }}">
        <label class="required">Class to be Linked</label>
           <select class="form-control select2" name="grade_id" style="width: 100%;">
            <option value="">--Select Class--</option>
              @foreach ($grades as $grade)
                  <option value="{{$grade->id}}">{{$grade->name}}</option>
              @endforeach
        </select>
      </div>
</div>
</div>