@extends('layouts.app')
@section('title')
    Create Lesson
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <form method="post" action="{{url('lesson')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="course_id" value="{{$courseId}}">

                            <label for="order">Order *</label>
                            <input type ="number" name="order" class="form-control" required>
                            <br>

                            <label for="lesson_title">Lesson Title *</label>
                            <input type ="text" name="lesson_title" class="form-control" required>
                            <br>

                            <label for="lesson_description">Lesson Description </label>
                            <textarea rows="4" cols="50" maxlength="250" name="lesson_description" class="form-control">
                            </textarea>
                            <br>

                            <label for="lesson_image">Lesson Image</label>
                            <input type ="file" name="lesson_image" >
                            <br>

                            <label for="lesson_video">Lesson video Url</label>
                            <input type ="text" name="lesson_video" class="form-control" >
                            <br>


                            <input type="submit"  class="btn btn-success" value="Create Lesson" >
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
