<html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'log')) }}
        {{ Form::select('signal_id', $signals) }}
        {{ Form::text('value') }}
        {{ Form::submit('submit') }}
        {{ Form::close() }}

        @foreach ($signals as $k => $v)
            <a href="/log/{{ $k }}">{{ $v }}</a> 
        @endforeach

        <div>{!! $chart->container() !!}</div>

        <ul>
            @foreach ($logs as $log)
                <li>[{{ $log->created_at }}]{{ $log->signal->name }} : {{ $log->value }}</li>
            @endforeach
        </ul>
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
        <!--        <script src="/js/manifest.js"></script>
        <script src="/js/vendor.js"></script>
        <script src="/js/app.js"</script> -->
        {!! $chart->script() !!}
    </body>
</html>
