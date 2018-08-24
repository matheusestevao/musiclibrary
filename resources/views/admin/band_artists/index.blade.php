@extends('adminlte::page')

@section('title', 'Band/Artist')

@section('content_header')
    <h1>@lang('message.Band/Artist')</h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.home') }}">Dashboard</a>
        </li>
        <li>@lang('Band/Artist')</li>
    </ol>
@stop

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <div class="box-body">
        @include('includes.alerts')
    </div>
	<div class="div-btn" style="margin-bottom: 25px;margin-top: 55px">
        <a href="{{ route('admin.bandArtist.create') }}" class="btn btn-success">@lang('message.Add Band/Artist')</a>
    </div>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="list-bandArtist" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row">
                                    <th width="5%">@lang('message.ID')</th>
                                    <th width="15%">@lang('message.Name')</th>
                                    <th width="15%">@lang('message.Genre')</th>
                                    <th width="15%">@lang('message.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                    	    @forelse($bandArtists as $bandArtist)
                                <tr class="register">
                                    <td>{{ $bandArtist->id }}</td>
                                    <td>{{ $bandArtist->name }}</td>
                                    <td>{{ $bandArtist->ReturnGenres($bandArtist->id) }}</td>
                                    <td class="justif">
                                        <a href="{{ route('admin.bandArtist.show', $bandArtist->id) }}" class="btn btn-primary">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.bandArtist.edit', $bandArtist->id) }}" class="btn btn-warning">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        
                                        <a href="#" data-id="{{ $bandArtist->id }}" data-route="{{ route('admin.bandArtist.destroy') }}"class="btn btn-danger btn-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            @empty
					            <tr class="text-center">
                                    <td colspan="4">@lang('message.Not Registry')</td>               
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
            $('#list-bandArtist').DataTable({
                language: {
                    url : "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json",
                },
                columns: [
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