@extends('layouts.app')
@section('title')
    Edit Lesson
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">

                        <form method="post" action="{{route('lesson.update',$lesson->lesson_id)}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PATCH">

                            <label for="order">Order *</label>
                            <input type ="number" name="order"  value="{{$lesson->order}}" class="form-control" required>
                            <br>

                            <label for="lesson_title">Lesson Title *</label>
                            <input type ="text" name="lesson_title" value= "{{$lesson->lesson_title}}" class="form-control" required>
                            <br>

                            <label for="lesson_description">Lesson Description </label>
                            <textarea rows="4" cols="50" maxlength="250" name="lesson_description" class="form-control">
                             {{$lesson->lesson_description}}
                            </textarea>
                            <br>

                            @if($lesson->lesson_image)
                                <img src="{{asset('images/'.$lesson->lesson_image)}}">
                            @endif
                            <br>
                            <label for="lesson_image">Lesson Image</label>
                            <input type ="file" name="lesson_image" >
                            <br>

                            <label for="lesson_video">Lesson video Url</label>
                            <input type ="text" name="lesson_video" value= "{{$lesson->lesson_video}}" class="form-control" >
                            <br>

                            <input type="submit" class="btn btn-success" value="Update Lesson" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
