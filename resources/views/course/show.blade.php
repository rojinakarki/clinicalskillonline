@extends('layouts.app')
@section('title')
    Course details
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Course Details
                    </div>
                    <div class="panel-body">


                        <ul>
                            <li><img src="{{asset('images/'.$course->course_coverimage)}}"></li>
                            <li>Title of course: {{$course->course_title}}</li>
                            <li>Status {{$course->course_status}}</li>
                            <li>Price {{$course->course_price}}</li>
                            <li>Description {{$course->course_description}}</li>
                            <li>Alternate text for image {{$course->course_alttext}}</li>
                            <li>Demo course {{$course->course_democourse}}</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
