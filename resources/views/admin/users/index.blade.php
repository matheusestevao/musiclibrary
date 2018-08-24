@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>@lang('message.User')</h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.home') }}">Dashboard</a>
        </li>
        <li>@lang('message.User')</li>
    </ol>
@stop

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <div class="box-body">
        @include('includes.alerts')
    </div>
	<div class="div-btn" style="margin-bottom: 25px;margin-top: 55px">
        <a href="{{ route('admin.user.create') }}" class="btn btn-success">@lang('message.Add User')</a>
    </div>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="list-user" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row">
                                    <th width="5%">@lang('message.ID')</th>
                                    <th width="15%">@lang('message.Name')</th>
                                    <th width="20%">@lang('message.E-mail')</th>
                                    <th width="20%">@lang('message.Profile')</th>
                                    <th width="15%">@lang('message.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                    	    @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->ReturnNameRole($user->id) }}</td>
                                    <td class="justif">
                                        <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-primary">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        
                                        <a href="#" data-route="{{ route('admin.user.destroy') }}" data-id="{{ $user->id }}" class="btn btn-danger btn-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            @empty
					            <tr class="text-center">
                                    <td colspan="4">Sem Registros</td>               
                                </tr>
                    	    @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->
    @include('includes.confirm')
    <script>
        $(document).ready(function() {

            $('#list-user').DataTable({
                language: {
                    url : "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json",
                },
                columns: [
                    null,
                    null,
                    null,
                    null,
                    { "orderable": false },
                ],
                "lengthMenu": [[15, 35, 70, -1], [15, 35, 70, "Todos"]]                
            });

        });
    </script>
@stop