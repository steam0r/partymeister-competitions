@extends('motor-backend::layouts.backend')

@section('htmlheader_title')
    {{ trans('motor-backend::backend/global.home') }}
@endsection

@section('contentheader_title')
    {{ trans('partymeister-competitions::backend/entries.entries') }}
    @if (has_permission('entries.write'))
        {!! link_to_route('backend.entries.create', trans('partymeister-competitions::backend/entries.new'), [], ['class' => 'pull-right float-right btn btn-sm btn-success']) !!}
    @endif
@endsection

@section('main-content')
    <div class="@boxWrapper">
        <div class="@boxHeader">
            @include('motor-backend::layouts.partials.search')
        </div>
        <!-- /.box-header -->
        @if (isset($grid))
            @include('motor-backend::grid.table')
        @endif
    </div>
    <partymeister-competitions-entry-modal :id="'entry-modal'"
                                           :label="'Entry modal window'"></partymeister-competitions-entry-modal>
@endsection
@section('view_scripts')
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        var apiToken = '{{Auth::user()->api_token}}';

        var switchCssClass = function (that, value, cssClass1, cssClass2) {
            if (value == true) {
                $(that).removeClass(cssClass2);
                $(that).addClass(cssClass1);
            } else {
                $(that).removeClass(cssClass1);
                $(that).addClass(cssClass2);
            }
        };

        var updateEntry = function (that, recordId, data, callback) {
            $.ajax({
                type: 'PATCH',
                url: '{{action('\Partymeister\Competitions\Http\Controllers\Api\EntriesController@index')}}/' + recordId + '?api_token=' + apiToken,
                data: data
            }).done(function (results) {
                callback(that, results);
            });
        };

        $('.delete-record').click(function (e) {
            if (!confirm('{{ trans('motor-backend::backend/global.delete_question') }}')) {
                e.preventDefault();
                return false;
            }
        });

        $('.change-sort-position').blur(function (e) {
            e.preventDefault();

            var data = {};
            data[$(this).data('field')] = $(this).val();

            updateEntry(this, $(this).data('record'), data, function (that, results) {
//                console.log(results);
            });
        });

        $('.change-entry-upload').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {upload_enabled: $(this).data('upload-enabled')}, function (that, results) {
                switchCssClass(that, results.data.upload_enabled, $(that).data('class'), $(that).data('class-alternate'));
                $(that).data('upload-enabled', results.data.upload_enabled ? 0 : 1);
            });
        });


        $('.change-entry-preparation').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {is_prepared: $(this).data('is-prepared')}, function (that, results) {
                switchCssClass(that, results.data.is_prepared, $(that).data('class'), $(that).data('class-alternate'));
                $(that).data('is-prepared', results.data.is_prepared ? 0 : 1);
            });
        });

        $('.change-entry-recording').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {is_recorded: $(this).data('is-recorded')}, function (that, results) {
                switchCssClass(that, results.data.is_recorded, $(that).data('class'), $(that).data('class-alternate'));
                $(that).data('is-recorded', results.data.is_recorded ? 0 : 1);
            });
        });

        $('.change-entry-gema').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {composer_not_member_of_copyright_collective: $(this).data('composer-gema')}, function (that, results) {
                switchCssClass(that, results.data.composer_not_member_of_copyright_collective, $(that).data('class'), $(that).data('class-alternate'));
                $(that).data('composer-gema', results.data.composer_not_member_of_copyright_collective ? 0 : 1);
            });
        });

        $('.change-entry-status').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {status: $(this).data('status')}, function (that, results) {
                $(that).parent().find('.change-entry-status').each(function (index, element) {
                    $(element).removeClass($(element).data('class'));
                    $(element).addClass('btn-outline-secondary');
                });
                $(that).removeClass('btn-outline-secondary');
                $(that).addClass($(that).data('class'));
            });
        });


        $('.show-entry-description').click(function (e) {
            e.preventDefault();
            $.ajax('{{action('\Partymeister\Competitions\Http\Controllers\Api\EntriesController@index')}}/' + $(this).data('id') + '?api_token=' + apiToken)
                .done(function (results) {
                    Vue.prototype.$eventHub.$emit('partymeister-competitions:show-entry-modal', results.data);
                    $('#entry-modal').modal('show')
                });
        });
    </script>
@append