@extends('layouts.app')
@section('title')
  UserGroup Page
    @endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach ($usergroup as $key => $val)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{$key}}">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
                                        {{ $val->usergroup_name }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{ $key }}" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="heading{{ $key }}">
                                <div class="panel-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <th colspan="4">Organization List
                                            <a class="btn btn-primary pull-right"
                                               href="{{url('organization/create',$val->usergroup_id)}}">
                                                Create Organization</a>
                                        </th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        @foreach($organization as $key1 => $org)
                                            @if($key == $key1)
                                                <tr>
                                                    <?php $sn = 0; ?>
                                                    @foreach($org as $key2 => $value)
                                                        <?php $sn++; ?>
                                                        @if(($sn)<=4)
                                                            <td> {{ $value->org_name }}
                                                                <a class="btn btn-warning btn"
                                                                   onclick="getDetail_edit({{$value->org_id}})"
                                                                   data-toggle="modal" data-target="#myUserGroup-OrgEditModal">
                                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                                </a>
                                                                <a class="btn btn-danger"
                                                                   onclick="return confirm('Are you sure?')"
                                                                   href="{{url('organization/destroy/'.$value->org_id.'/1')}}">

                                                                    <span class="glyphicon glyphicon-trash"></span>
                                                                </a>
                                                            </td>
                                                        @else
                                                </tr>
                                                <tr>
                                                    <?php $sn = 1; ?>
                                                    <td> {{ $value->org_name }}
                                                        <a class="btn btn-warning btn"
                                                           onclick="getDetail_edit({{$value->org_id}})"
                                                           data-toggle="modal" data-target="#myUserGroup-OrgEditModal">
                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                        </a>
                                                        <a class="btn btn-danger"
                                                           onclick="return confirm('Are you sure?')"
                                                           href="{{url('organization/destroy/'.$value->org_id.'/1')}}">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                        </a>
                                                    </td>
                                                        @endif
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{--Show  Modal --}}
            <div class="modal fade" id="myUserGroupShowModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">User Group Details</h4>
                        </div>

                        <div class="modal-body">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                <tr><td>Usergroup Name</td><td> <span id="usergroup_name"></span></td></tr>
                                <tr><td>Usergroup Tag</td><td> <span id="usergroup_tag"></span></td></tr>
                                </tbody>
                            </table>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>

            </div>

            {{--Edit Modal--}}
            <div class="modal fade" id="myUserGroup-OrgEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Organization</h4>
                        </div>
                        <form method="post" action="{{route('organization.update',$value->org_id)}}">
                            <div class="modal-body">
                                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                <label for="org_name">Organization Name </label>
                                <input type="text" id="org_name" name="org_name" class="form-control">
                                <input type="hidden" id="org_id" name="org_id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    {{--<form  method="get" action="{{route('usergroup.edit',$var->usergroup_id)}}">--}}
    {{--<input type="submit" class="btn btn-success" value="EDIT">--}}
    {{--</form>--}}

    {{--Call show--}}
    {{--<a class="btn btn-success "--}}
    {{--onclick="getDetail_show({{$var->usergroup_id}})"--}}
    {{--data-toggle="modal" data-target="#myUserGroupShowModal">--}}
    {{--<span class="glyphicon glyphicon-eye-open"></span>--}}
    {{--</a>--}}

    {{-- Call Delete --}}
    {{--<form class="delete" method="post" action="{{route('usergroup.destroy',$var->usergroup_id)}}">--}}
    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    {{--<input type="hidden" name="_method" value="DELETE">--}}
    {{--<input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" value="DELETE">--}}
    {{--</form>--}}
            <script>
                function getDetail_show(id) {
                    var url = "{{url('usergroup/showUsergroupModal')}}/" + id;
                    var token = "{{ csrf_token() }}";
                    $.get(url,function (res) {
                        var usergroup_name = res.usergroup_name;
                        var usergroup_tag = res.usergroup_tag;
                        var usergroup_id =res.usergroup_id

                        $('#usergroup_name').text(usergroup_name);
                        $('#usergroup_tag').text(usergroup_tag);
                        $('#usergroup_id').text(usergroup_id);
                    });
                }
                function getDetail_edit(id) {
                    var url = "{{url('organization/editOrganization')}}/" + id;
                    var token = "{{ csrf_token() }}";
                    $.get(url, function (res) {
                        alert (res);
                        var org_name = res.org_name;
                        var org_id = res.org_id;

                        $('#org_name').val(org_name);
                        $('#org_id').val(org_id);
                    });

                }
            </script>
@endsection
