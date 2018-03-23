@extends('layouts.app')
@section('title')
    Package Page
@endsection
@section('content')
    <script>
        function getDetail(id) {
            var url = "{{url('package/showPackageModal')}}/" + id;
            var token = "{{ csrf_token() }}";
            $.get(url,function (res) {
                console.log(res);
                var package_name = res.package_name;
                var package_price = res.package_price;
                var courses_titles=res.courses_titles;
                $('#package_name').text(package_name);
                $('#package_price').text(package_price);
                $('#course').html(courses_titles);

            });
        }
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('package/create')}}"><input type="submit" value="Create Package"> </a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>Package Name</th>
                            <th>Package Price</th>
                            <th>Courses in this package</th>
                            </thead>
                            <tbody>
                            @foreach($package as $var)
                                <tr>
                                    <td><a href ="{{url('package',$var->package_id)}}">{{$var->package_name}}</a></td>
                                    <td>{{$var->package_price}}</td>
                                    <td>{!!$var->courses_titles  !!}</td>
                                    <td>
                                        <div class ="btn-toolbar">
                                            <a class="btn btn-warning" href="{{'package/'.$var->package_id.'/edit'}}">
                                                <span class="glyphicon glyphicon-edit"></span></a>
                                            </a>

                                            <a class="btn btn-success"
                                               onclick="getDetail({{$var->package_id}})"
                                               data-toggle="modal" data-target="#myPackageModal">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </a>

                                            <form class="delete" method="post"
                                                  onclick="return confirm('Are you sure you want to delete package?')"
                                                  action="{{route('package.destroy',$var->package_id)}}">
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
        <!-- Modal -->
        <div class="modal fade" id="myPackageModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Package Details</h4>
                    </div>

                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr><td>Package Name  </td><td> <span id="package_name"></span></td></tr>
                            <tr><td>Package Price </td><td> <span id="package_price"></span></td></tr>
                            <tr><td>Package Course</td><td> <span id="course"></span></td></tr>

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
