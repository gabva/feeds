<div class="box-body">

    <h3>Rappel sur la validité des URL</h3>
    <p>Sont valides :
    <ul>
        <li>Une <strong>page facebook</strong> (pas de profil perso, ni groupe). Ayant des adresses de type :
            <ul>
                <li><strong class="text-success">https://www.facebook.com/le-nom-de-la-page</strong></li>
                <li><strong class="text-success">https://www.facebook.com/123456789</strong></li>
                <li>Si l'adresse est : <strong class="text-danger">https://www.facebook.com/le-nom-de-la-page-123456789</strong>, alors essayez simplement <strong class="text-success">https://www.facebook.com/123456789</strong> </li>

            </ul>

        </li>
        <li>Un flux RSS de site ou blog valide</li>
    </ul>


    </p>

    <div class="box-body">

        <div class='form-group {{ $errors->has("name") ? ' has-error' : '' }}'>
            {!! Form::label("name", trans('feeds::feeds.form.name')) !!}
            {!! Form::text("name",null, ['class' => "form-control", 'placeholder' => trans('feeds::feeds.form.name')]) !!}
            {!! $errors->first("name", '<span class="help-block">:message</span>') !!}
        </div>

        <div class='form-group {{ $errors->has("url") ? ' has-error' : '' }}'>
            {!! Form::label("url", trans('feeds::feeds.form.url')) !!}
            {!! Form::text("url",null, ['class' => "form-control", isset($feed) ? "disabled":"", 'placeholder' => trans('feeds::feeds.form.url')]) !!}
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