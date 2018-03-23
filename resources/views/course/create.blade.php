@extends('layouts.app')
@section('title')
    Create Course
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <form method="post" action="{{url('course')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label for="course_status">Status </label>
                            <select id="course_status" name="course_status" class="form-control">
                                <option value="in-development">In development </option>
                                <option value="live" >Live </option>
                            </select>
                            <br>

                            <div class="form-group">
                                <label for="course_title">Course Title *</label>
                                <input type ="text" name="course_title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="course_price">Price *</label>
                                <input type ="number" name="course_price" class="form-control" min="0" placeholder="0" required>
                            </div>

                            <div class="form-group">
                                <label for="course_description">Description</label>
                                <textarea rows="4" cols="50" maxlength="250" name="course_description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="course_coverimage">CoverImage</label>
                                <input type ="file" name="course_coverimage" >
                            </div>

                            <div class="form-group">
                                <label for="course_alttext">Alt Text </label>
                                <input type ="text" name="course_alttext" class="form-control" >
                            </div>

                            <div class="form-group">
                                <table>
                                    <tr>
                                        <td >
                                           <input type="checkbox" name="course_democourse"
                                                    value="1" class="form-control">
                                        </td>
                                        <td> Demo Course </td>
                                </tr>
                                </table>
                            </div>

                            <input type="submit"  value="Create Course" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
