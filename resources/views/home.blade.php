@extends('layouts.app')
@section('title')
    Home Page
@stop
@section('nav')
    @if(Auth::user()->role =='superadmin')
        @include('partials.superadmin_navbar')
    @elseif(Auth::user()->role =='admin')
        @include('partials.admin_navbar')
    @elseif(Auth::user()->role =='manager')
        @include('partials.manager_navbar')
    @else
        @include('partials.learner_navbar')
    @endif
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
