@extends('layouts.app')
@section('title')
    Lesson Page
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <strong>List of Lesson </strong>
                        <form method="get" action="{{url('course')}}">
                            <input type="submit" class="btn btn-normal" value="Add Lesson">
                        </form>

                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>Course</th>
                            <th>Lesson</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Video</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($lesson as $var)
                                <tr>
                                    <td>{{$var->course->course_title}}</td>
                                    <td>{{$var->lesson_title}}</td>
                                    <td>{{$var->lesson_description}}</td>
                                    <td>@if($var->lesson_image)
                                            <img src="{{asset('images/'.$var->lesson_image)}}">
                                        @endif
                                    </td>
                                    <td>
                                        @if($var->lesson_video)
                                            <iframe width="300"
                                                    height="215" src="//www.youtube.com/embed/{{$var->lesson_video}}"
                                                    frameborder="0" allowfullscreen>
                                            </iframe>
                                        @endif

                                    </td>

                                    <td>
                                        <div class="btn-toolbar">

                                            <a class="btn btn-warning" href="{{'lesson/'.$var->lesson_id.'/edit'}}">
                                                <span class="glyphicon glyphicon-edit"></span></a>
                                            </a>


                                            <form class="delete" method="post"
                                                  onclick="return confirm('Are you sure you want to delete the lesson?')"
                                                  action="{{route('lesson.destroy',$var->lesson_id)}}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-del" type="submit">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
