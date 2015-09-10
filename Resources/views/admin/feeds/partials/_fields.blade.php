<div class="box-body">

    <div class="box-body">

        <div class='form-group {{ $errors->has("name") ? ' has-error' : '' }}'>
            {!! Form::label("name", trans('feeds::feeds.form.name')) !!}
            {!! Form::text("name",null, ['class' => "form-control", 'placeholder' => trans('feeds::feeds.form.name')]) !!}
            {!! $errors->first("name", '<span class="help-block">:message</span>') !!}
        </div>

        <div class='form-group {{ $errors->has("url") ? ' has-error' : '' }}'>
            {!! Form::label("url", trans('feeds::feeds.form.url')) !!}
            {!! Form::text("url",null, ['class' => "form-control", 'placeholder' => trans('feeds::feeds.form.url')]) !!}
            {!! $errors->first("url", '<span class="help-block">:message</span>') !!}
        </div>

        <div class='form-group {{ $errors->has("status") ? ' has-error' : '' }} '>
            {!! Form::label("status", trans('feeds::feeds.form.status')) !!}
            {!! Form::select('status', $statuses,isset($feed) ? $feed->status : null,['class'=>"form-control"]) !!}
            {!! $errors->first("status", '<span class="help-block">:message</span>') !!}
        </div>

        <div class='form-group {{ $errors->has("comment") ? ' has-error' : '' }}'>
            {!! Form::label("comment", trans('feeds::feeds.form.comment')) !!}
            {!! Form::textarea("comment",null, ['class' => "form-control", 'placeholder' => trans('feeds::feeds.form.comment')]) !!}
            {!! $errors->first("comment", '<span class="help-block">:message</span>') !!}
        </div>

    </div>

</div>