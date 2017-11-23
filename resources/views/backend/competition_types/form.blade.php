{!! form_start($form) !!}
<div class="@boxWrapper box-primary">
    <div class="@boxHeader with-border">
        <h3 class="box-title">{{ trans('motor-backend::backend/global.base_info') }}</h3>
    </div>
    <div class="@boxBody">
        {!! form_row($form->name) !!}
        <div class="row">
            <div class="col-md-3">
                {!! form_row($form->has_screenshot) !!}
            </div>
            <div class="col-md-3">
                {!! form_row($form->has_audio) !!}
            </div>
            <div class="col-md-3">
                {!! form_row($form->has_video) !!}
            </div>
            <div class="col-md-3">
                {!! form_row($form->has_recordings) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                {!! form_row($form->has_platform) !!}
            </div>
            <div class="col-md-3">
                {!! form_row($form->has_filesize) !!}
            </div>
            <div class="col-md-3">
                {!! form_row($form->has_composer) !!}
            </div>
            <div class="col-md-3">
                {!! form_row($form->is_anonymous) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                {!! form_row($form->has_remote_entries) !!}
            </div>
            <div class="col-md-3">
                {!! form_row($form->file_is_optional) !!}
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="@boxFooter">
        {!! form_row($form->submit) !!}
    </div>
</div>
{!! form_end($form) !!}
