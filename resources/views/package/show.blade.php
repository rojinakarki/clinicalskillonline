@extends('layouts.app')
@section('title')
    Package details
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Package Details
                    </div>
                    <div class="panel-body">

                        <ul>
                            <li>Package Name  : {{$package->package_name}}</li>
                            <li>Package Price : {{$package->package_price}}</li>
                            <li>Courses in this package :-</li>
                            <ol>
                            @foreach($course as $var)
                            <li>{{$var->course_title}}</li>
                                @endforeach
                            </ol>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
