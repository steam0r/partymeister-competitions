{!! form_start($form) !!}
<div class="@boxWrapper box-primary">
    @foreach ($competitions as $competition)
        <div class="@boxHeader with-border">
            <h3 class="box-title">{{$competition->name}}</h3>
        </div>
        <div class="@boxBody">
            @for($i=1; $i<=3; $i++)
            <div class="row">
                <div class="col-md-1">
                    <label class="control-label">Rank</label>
                    <p>
                        #{{$i}}
                    </p>
                </div>
                <div class="col-md-2">
                    {!! form_row($form->{'amount['.$competition->id.']['.$i.']'}) !!}
                </div>
                <div class="col-md-9">
                    {!! form_row($form->{'additional['.$competition->id.']['.$i.']'}) !!}
                </div>
            </div>
            @endfor
        </div>
    @endforeach
    <!-- /.box-body -->

    <div class="@boxFooter">
        {!! form_row($form->submit) !!}
    </div>
</div>
{!! form_end($form) !!}
