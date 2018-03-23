@extends('layouts.app')
@section('title')
    Edit Package
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <form method="Post" action="{{action('PackageController@update',$package->package_id)}}" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PATCH">

                            <div class="form-group">
                                <label for="package_name">Package Name *</label>
                                <input type ="text" name="package_name" value="{{$package->package_name}}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="package_price">Package Price *</label>
                                <input type ="text" name="package_price" value="{{$package->package_price}}" class="form-control" required>
                            </div>


                            <div class="form-group">
                                <label for="package_course">Select Courses for this package *</label>
                                <table class="table-hover">
                                    @foreach($course as $var)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="package_course[]"
                                                       value="{{$var->course_id}}"
                                                       @if (in_array($var->course_id,$checked_var)) checked @endif
                                                       class="form-control">
                                            </td>
                                            <td>{{$var->course_title}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                            <input type="submit"  value="Update Course" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
