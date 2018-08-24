@extends('adminlte::page')

@section('content_header')
    @if (!isset($user))
        <h1>@lang('message.Add') - @lang('message.User')</h1>
    @else
        <h1>@lang('message.Edit') - @lang('message.User')</h1>
    @endif
    

    <ol class="breadcrumb">
        <li>
        	<a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li>
        	<a href="{{ route('admin.user.index') }}">@lang('message.User')</a>
        </li>
        @if (!isset($user))
            <li>@lang('message.Add')</li>
        @else
            <li>@lang('message.Edit')</li>
        @endif
    </ol>
@stop

@section('content')
    @include('includes.alerts')
        @if (!isset($user)) 
            <form role="form" method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
        @else
            <form role="form" method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
        @endif
        <div class="box box-success">
            <div class="box-body">
                <div class="clearfix"> </div>

                {!! csrf_field() !!}
                <div class="form-group col-md-4" id="div-name">
                    <label>@lang('message.Name'):</label>
                    <input name="name" id="name" type="text" class="name form-control" placeholder="@lang('message.Name')" value="{{ $user->name or old('name') }}">
                </div>

                <div class="form-group col-md-4" id="div-email">
                    <label>@lang('message.E-mail'):</label>
                    <input name="email" id="email" type="text" class="email form-control" placeholder="@lang('message.E-mail')" value="{{ $user->email or old('email') }}">
                </div>

                <div class="form-group col-md-4" id="div-image">
                    <label>@lang('message.Avatar'):</label>
                    <input name="image" id="image" type="file" class="image form-control" placeholder="@lang('message.Avatar')">
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-md-4" id="div-password">
                    <label>@lang('message.Password'):</label>
                    <input name="password" id="password" type="password" class="password form-control" placeholder="@lang('message.Password')">
                </div>

                <div class="form-group col-md-4" id="div-password_confirmation">
                    <label>@lang('message.Confirm Password'):</label>
                    <input name="password_confirmation" id="password_confirmation" type="password" class="password_confirmation form-control" placeholder="@lang('message.Confirm Password')">
                </div>

                <div class="form-group col-md-4" id="div-profile">
                    <label>@lang('message.Profile'):</label>
                    <select name="profile" id="profile" class="profile form-control">
                        <option value="">@lang('message.Select')</option>
                        @foreach ($profiles AS $profile)
                            <option value="{{ $profile->id }}"  {{ isset($user) ? ($profile->id == $user->ReturnRoleUser() ? 'selected' : '') : $profile->id == old('profile') ? 'selected' : '' }}>
                                {{ $profile->label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="box-footer">
                    <div class="col-md-6">
                        <a href="{{route('admin.user.index')}}" class="btn btn-warning btn-back">@lang('Back')</a>
                    </div>
                    
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-save">@lang('Save') <i class="fa fa-save"></i></button>
                    </div>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box-body -->
        </div>
    </form>    
@stop