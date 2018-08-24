@extends('adminlte::page')

@section('content_header')
    @if (!isset($bandArtist))
        <h1>@lang('message.Add') - @lang('message.Band/Artist')</h1>
    @else
        <h1>@lang('message.Edit') - @lang('message.Band/Artist')</h1>
    @endif
    

    <ol class="breadcrumb">
        <li>
        	<a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li>
        	<a href="{{ route('admin.bandArtist.index') }}">@lang('message.Band/Artist')</a>
        </li>
        @if (!isset($bandArtist))
            <li>@lang('message.Add')</li>
        @else
            <li>@lang('message.Edit')</li>
        @endif
    </ol>
@stop

@section('content')
    @include('includes.alerts')
    @if (!isset($bandArtist)) 
        <form role="form" method="POST" action="{{ route('admin.bandArtist.store') }}" enctype="multipart/form-data">
    @else
        <form role="form" method="POST" action="{{ route('admin.bandArtist.update', $bandArtist->id) }}" enctype="multipart/form-data">
    @endif
    <div class="box box-success">
        <div class="box-body">
            <div class="clearfix"> </div>
            {!! csrf_field() !!}
            <div class="form-group col-md-3" id="div-type">
                <label>@lang('message.Type'):</label>
                <select name="type" id="type" class="type form-control">
                    <option value="">@lang('message.Select')</option>
                    <option value="Band">@lang('message.Band')</option>
                    <option value="Artist">@lang('message.Artist')</option>
                </select>
            </div>

            <div class="form-group col-md-5" id="div-name">
                <label>@lang('message.Name'):</label>
                <input name="name" id="name" type="text" class="name form-control" placeholder="@lang('message.Name')" value="{{ $user->name or old('name') }}">
            </div>

            <div class="form-group col-md-4" id="div-image">
                <label>@lang('message.Image Band/Artist'):</label>
                <input name="image" id="image" type="file" class="image form-control" placeholder="@lang('message.Avatar')">
            </div>

            <div class="clearfix"></div>

            <div class="form-group col-md-12" id="div-genre">
                <label>@lang('message.Genre'):</label>
                <select name="genre[]" id="genre" class="genre form-control"  multiple="multiple">
                    <option value="">@lang('message.Select')</option>
                    @foreach ($genres AS $genre)
                        <option value="{{ $genre->id }}"  {{ isset($user) ? ($genre->id == $bandArtist->id ? 'selected' : '') : $genre->id == old('genre') ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            

            <div class="clearfix"></div>

            <div class="form-group col-md-12" id="div-password">
                <label>@lang('message.Description'):</label>
                <textarea rows="15" name='description' id='description' class="form-control description"></textarea>
            </div>            

            <div class="box-footer">
                <div class="col-md-6">
                    <a href="{{route('admin.bandArtist.index')}}" class="btn btn-warning btn-back">@lang('message.Back')</a>
                </div>
                
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary btn-save">@lang('message.Save') <i class="fa fa-save"></i></button>
                </div>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.box-body -->
    </div>
    </form>

    <script>
        $(document).ready(function () {
            $('.genre').select2();
        })
    </script>
@stop