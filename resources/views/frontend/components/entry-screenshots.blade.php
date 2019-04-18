<div class="component-entry-screenshot">
    <h4>Upload screenshot</h4>
    @include('motor-backend::errors.list')
    {!! form_start($entryScreenshotForm) !!}
    <div class="@boxWrapper box-primary">
        <div class="@boxHeader with-border">
            <h5 class="box-title">Your entry</h5>
        </div>
        <div class="@boxBody">
            {{$record->title}} by {{$record->author}}
        </div>
        <!-- /.box-body -->
    </div>
    <div class="@boxWrapper box-primary">
        <div class="@boxHeader with-border">
            <h5 class="box-title">Screenshot</h5>
        </div>
        <div class="@boxBody">
            @if ($entryScreenshotForm->has('screenshot'))
                {!! form_row($entryScreenshotForm->screenshot, ['label' => false]) !!}
            @endif
        </div>
        <div class="@boxFooter">
            {!! form_row($entryScreenshotForm->submit) !!}
        </div>
        <!-- /.box-body -->
    </div>
</div>
{!! form_end($entryScreenshotForm, false) !!}
