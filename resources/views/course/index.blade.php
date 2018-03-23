@extends('layouts.app')
@section('title')
    Course Page
@endsection
@section('content')
    <script>
        function getDetail(id) {
            var url = "{{url('course/showCourseModal')}}/" + id;
            var token = "{{ csrf_token() }}";
            $.get(url,function (res) {
                var course_title = res.course_title;
                var course_status = res.course_status;
                var course_description = res.course_description;
                var course_price = res.course_price;
                var course_coverimage = res.course_coverimage;
                var course_alttext = res.course_alttext;
                var course_democourse = res.course_democourse;
                $('#course_title').text(course_title);
                $('#course_status').text(course_status);
                $('#course_description').text(course_description);
                $('#course_price').text(course_price);
                var image="{{asset('images/')}}/" + course_coverimage;
                $('#course_coverimage').html('<img src="'+image+'">');
                $('#course_alttext').text(course_alttext);
                $('#course_democourse').text(course_democourse);
            });
        }
    </script>
    <div class="container">
         <div class="row">
             <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('/course/create')}}"><input type="submit" value="Create Course"> </a>

                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>Course Title</th>
                            <th>Status</th>
                            <th>Cover Image</th>
                            <th>Price</th>
                            <th>Action</th>

                            </thead>
                            <tbody>
                            @foreach($course as $var)
                                <tr>
                                    <td><a href ="{{url('course',$var->course_id)}}">{{$var->course_title}}</a></td>
                                    <td>{{$var->course_status}}</td>
                                    <td><img src="{{asset('images/'.$var->course_coverimage)}}" alt="{{$var->course_alttext}}"></td>
                                    <td>{{$var->course_price}}</td>
                                    <td>
                                        <div class="btn-toolbar">
                                            {{--call edit--}}
                                            <a class="btn btn-warning" href="{{'course/'.$var->course_id.'/edit'}}">
                                                <span class="glyphicon glyphicon-edit"></span></a>
                                            </a>
                                            {{--call view--}}
                                            <a class="btn btn-success"
                                               onclick="getDetail({{$var->course_id}})"
                                               data-toggle="modal" data-target="#myCourseModal">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </a>
                                            {{--call delete--}}
                                            <form class="delete" method="post"
                                                  onclick="return confirm('Are you sure you want to delete the course?')"
                                                  action="{{route('course.destroy',$var->course_id)}}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-del" type="submit">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="btn-others">
                                            {{--call create lesson--}}
                                            <form class="createLesson" method="get" action="{{url('/lesson/create',$var->course_id)}}">
                                                <button class="btn btn-primary" type="submit"> Add Lesson </button>
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
        <!-- Modal -->
        <div class="modal fade" id="myCourseModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Course Details</h4>
                    </div>

                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr><td>Course Title  </td><td> <span id="course_title"></span></td></tr>
                            <tr><td>Course Status </td><td> <span id="course_status"></span></td></tr>
                            <tr><td>Course Description </td><td> <span id="course_description"></span></td></tr>
                            <tr><td>Course Price</td><td><span id="course_price"></span></td></tr>
                            <tr><td>Course CoverImage</td><td><span id="course_coverimage"></span></td></tr>
                            <tr><td>Democourse </td><td><span id="course_democourse"></span></td></tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
