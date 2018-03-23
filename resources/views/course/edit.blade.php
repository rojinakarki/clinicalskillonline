@extends('layouts.app')
@section('title')
    Edit Course
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                            <form method="Post" action="{{action('CourseController@update',$course->course_id)}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PATCH">
                                <label for="course_status">Status </label>
                                <select id="course_status" name="course_status"  class="form-control">
                                    <option value="in-development" @if ('in-development' == $course->course_status) selected @endif>In development </option>
                                    <option value="live"  @if ('live' == $course->course_status) selected @endif>Live </option>
                                </select>
                                <br>

                                <label for="course_title">Title of course </label>
                                <input type ="text" name="course_title" value="{{$course->course_title}}" class="form-control" required>
                                <br>

                                <label for="course_price">Price </label>
                                <input type ="number" name="course_price" value="{{$course->course_price}}" class="form-control" min="0" placeholder="0" required>
                                <br>

                                <label for="course_description">Description</label>
                                <textarea rows="4" cols="50" maxlength="250" name="course_description"  class="form-control">{{$course->course_description}}</textarea>
                                <br>

                                @if($course->course_coverimage)
                                    <img src="{{asset('images/'.$course->course_coverimage)}}" alt="{{$course->course_alttext}}">
                                @endif
                                <br>
                                <label for="course_coverimage">Update CoverImage</label>
                                <input type ="file" name="course_coverimage">
                                <br>

                                <label for="course_alttext">Alt Text </label>
                                <input type ="text" name="course_alttext" value="{{$course->course_alttext}}" class="form-control" >
                                <br>

                                <label for="course_democourse">Demo Course</label>
                                <input type="checkbox" name="course_democourse"  value="1"  class="form-control">

                                <br>

                                <input type="submit"  class="btn btn-success" value="Update Course" >
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
