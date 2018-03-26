{!! form_start($form) !!}
<div class="@boxWrapper box-primary">
    @foreach ($results as $competition)
        <div class="@boxHeader">
            <h3 class="box-title">{{$competition['name']}}</h3>
        </div>
        <div class="@boxBody">
            @foreach ($competition['entries'] as $entry)
                <div class="row">
                    <div class="col-md-1">
                        {{number_format($entry['points'], 0,',','')}}
                    </div>
                    <div class="col-md-5">
                        {{$entry['title']}}
                    </div>
                    <div class="col-md-5">
                        {{$entry['author']}}
                    </div>
                    <div class="col-md-1">
                        {!! form_row($form->{'entry['.$competition['id'].']['.$entry['id'].']'}) !!}
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <div class="@boxFooter">
        {!! form_row($form->submit) !!}
    </div>
</div>
{!! form_end($form) !!}
