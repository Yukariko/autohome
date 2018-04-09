{{ $errors }}
{{ Form::open(array('url' => 'log')) }}
    {{ Form::select('signal_id', $signals) }}
    {{ Form::text('value') }}
    {{ Form::submit('submit') }}
{{ Form::close() }}
@foreach ($signals as $k => $v)
    <a href="/log/{{ $k }}">{{ $v }}</a> 
@endforeach
<ul>
@foreach ($logs as $log)
    <li>[{{ $log->created_at }}]{{ $log->signal->name }} : {{ $log->value }}</li>
@endforeach
</ul>
