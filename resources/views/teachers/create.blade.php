@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.create'):</h4>

    {!! Form::open(['url' => route('teachers.store')]) !!}

    <div class="form-group">
        {{ Form::label('last_name', __('users.last_name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'last_name',
            old('last_name'),
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', __('users.name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'name',
            old('name'),
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('second_name', __('users.second_name'), ['class' => 'control-label']) }}
        {{ Form::text(
            'second_name',
            old('second_name'),
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', __('scheduler.email'), ['class' => 'control-label']) }}
        {{ Form::email(
            'email',
            old('email'),
            [
            'class' => 'form-control',
            ]
           ) }}
    </div>
    <div class="form-group">
        {{ Form::label('subject_id', __('scheduler.subjects'), ['class' => 'control-label']) }}
        {{ Form::select(
            'subject_id',
            $subjects,
            old('subject_id'),
            [
            'class' => 'selectpicker form-control',
            'multiple',
            'data-max-options' => '20',
            'data-live-search' => 'true',
            'name' => 'subject_id[]',
            ]
           ) }}
    </div>

    {{Form::submit(__('buttons.save'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection
