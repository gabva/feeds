@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('feeds::feeds.title.create feed') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ URL::route('admin.feeds.feed.index') }}">{{ trans('feeds::feeds.title.feeds') }}</a></li>
        <li class="active">{{ trans('feeds::feeds.title.create feed') }}</li>
    </ol>
@stop

@section('styles')

@stop

@section('content')
    {!! Form::model(new Modules\Feeds\Entities\Feed,['route' => ['admin.feeds.feed.store'], 'method' => 'post']) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers', ['fields' => ['title', 'body']])
                <div class="tab-content">
                    <?php $i = 0; ?>
                    <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                    <?php $i++; ?>
                    <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                        @include('feeds::admin.feeds.partials._fields', ['lang' => $locale])
                    </div>
                    <?php endforeach; ?>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.feeds.feed.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>

    </div>

    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('feeds::feeds.navigation.back to index') }}</dd>
    </dl>
@stop

@section('scripts')

    @include('feeds::admin.feeds.partials._scripts' )

@stop