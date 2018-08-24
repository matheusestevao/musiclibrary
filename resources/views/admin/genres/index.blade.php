@extends('adminlte::page')

@section('title', 'Band/Artist')

@section('content_header')
    <h1>@lang('message.Genre')</h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.home') }}">Dashboard</a>
        </li>
        <li>@lang('Genre')</li>
    </ol>
@stop

@section('content')
    <div class="box-body">
        @include('includes.alerts')
    </div>
	<div class="div-btn" style="margin-bottom: 25px;margin-top: 55px">
        <a href="{{ route('admin.genre.create') }}" class="btn btn-success">@lang('message.Add User')</a>
    </div>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="list-genre" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row">
                                    <th width="5%">@lang('message.ID')</th>
                                    <th width="15%">@lang('message.Name')</th>
                                </tr>
                            </thead>
                            <tbody>
                    	    @forelse($genres as $genre)
                                <tr>
                                    <td>{{ $genre->id }}</td>
                                    <td>{{ $genre->name }}</td>
                                    <td class="justif">
                                        <a href="{{ route('admin.genre.edit', $genre->id) }}" class="btn btn-warning">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
					            <tr class="text-center">
                                    <td colspan="2">@lang('message.Not Registry')</td>               
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
    <script>
        $(document).ready(function() {

            $('#list-genre').DataTable({
                language: {
                    url : "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json",
                },
                columns: [
                    null,
                    null,
                    { "orderable": false },
                ],
                "lengthMenu": [[15, 35, 70, -1], [15, 35, 70, "Todos"]]                
            });

        });
    </script>
@stop