{{ Form::open(array('url' => 'signal')) }}
    {{ Form::text('name') }}
    {{ Form::text('description') }}
    {{ Form::submit('submit') }}
{{ Form::close() }}
<ul>
@foreach ($signals as $signal)
    <li>{{ $signal->name }} : {{ $signal->description }}</li>
@endforeach
</ul>
