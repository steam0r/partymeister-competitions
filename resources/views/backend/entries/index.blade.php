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

        let apiToken = '{{Auth::user()->api_token}}';

        let switchCssClass = function (that, value, cssClass1, cssClass2) {
            if (value == true) {
                $(that).removeClass(cssClass2);
                $(that).addClass(cssClass1);
            } else {
                $(that).removeClass(cssClass1);
                $(that).addClass(cssClass2);
            }
        };

        let updateEntry = function (that, recordId, data, callback) {
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

            let data = {};
            data[$(this).data('field')] = $(this).val();

            updateEntry(this, $(this).data('record'), data, function (that, results) {
                toastr.options = {progressBar: true};
                toastr.success('{{trans('partymeister-competitions::backend/entries.sort_position_updated')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
            });
        });

        $('.change-entry-upload').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {upload_enabled: $(this).data('upload-enabled')}, function (that, results) {
                switchCssClass(that, results.data.upload_enabled, $(that).data('class'), $(that).data('class-alternate'));

                toastr.options = {progressBar: true};
                if (results.data.upload_enabled === false) {
                    toastr.success('{{trans('partymeister-competitions::backend/competitions.upload_disabled')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                } else {
                    toastr.success('{{trans('partymeister-competitions::backend/competitions.upload_enabled')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                }

                $(that).data('upload-enabled', results.data.upload_enabled ? 0 : 1);
            });
        });


        $('.change-entry-preparation').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {is_prepared: $(this).data('is-prepared')}, function (that, results) {
                switchCssClass(that, results.data.is_prepared, $(that).data('class'), $(that).data('class-alternate'));

                toastr.options = {progressBar: true};
                if (results.data.is_prepared === true) {
                    toastr.success('{{trans('partymeister-competitions::backend/entries.entry_prepared')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                } else {
                    toastr.success('{{trans('partymeister-competitions::backend/entries.entry_not_prepared')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                }

                $(that).data('is-prepared', results.data.is_prepared ? 0 : 1);
            });
        });

        $('.change-entry-recording').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {is_recorded: $(this).data('is-recorded')}, function (that, results) {
                switchCssClass(that, results.data.is_recorded, $(that).data('class'), $(that).data('class-alternate'));

                toastr.options = {progressBar: true};
                if (results.data.is_recorded === true) {
                    toastr.success('{{trans('partymeister-competitions::backend/entries.entry_recorded')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                } else {
                    toastr.success('{{trans('partymeister-competitions::backend/entries.entry_not_recorded')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                }

                $(that).data('is-recorded', results.data.is_recorded ? 0 : 1);
            });
        });

        $('.change-entry-gema').click(function (e) {
            e.preventDefault();

            updateEntry(this, $(this).data('entry'), {composer_not_member_of_copyright_collective: $(this).data('composer-gema')}, function (that, results) {
                switchCssClass(that, results.data.composer_not_member_of_copyright_collective, $(that).data('class'), $(that).data('class-alternate'));

                toastr.options = {progressBar: true};
                if (results.data.composer_not_member_of_copyright_collective === true) {
                    toastr.success('{{trans('partymeister-competitions::backend/entries.gema_checked')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                } else {
                    toastr.success('{{trans('partymeister-competitions::backend/entries.gema_not_checked')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                }

                $(that).data('composer-gema', results.data.composer_not_member_of_copyright_collective ? 0 : 1);
            });
        });

        $('.change-entry-livevote').click(function (e) {
          e.preventDefault();

          var that = this;

          $.ajax({
            type: 'PATCH',
            url: '<?php echo e(action('\Partymeister\Competitions\Http\Controllers\Api\EntriesController@index')); ?>/' + $(this).data('entry') + '?api_token=' + apiToken,
            data: {enable_livevoting: true}
          }).done(function (results) {
            switchCssClass(that, results.data.enable_livevoting, $(that).data('class'), $(that).data('class-alternate'));

            toastr.options = {progressBar: true};
            if (results.data.enable_livevoting === true) {
              toastr.success('Enable Live-Voting', '<?php echo e(trans('motor-backend::backend/global.flash.success')); ?>');
            } else {
              toastr.success('Disabled Live-Voting', '<?php echo e(trans('motor-backend::backend/global.flash.success')); ?>');
            }
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

                toastr.options = {progressBar: true};
                switch (results.data.status_value) {
                    case 0:
                        toastr.success('{{trans('partymeister-competitions::backend/entries.status_unchecked')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                        break;
                    case 1:
                        toastr.success('{{trans('partymeister-competitions::backend/entries.status_checked')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                        break;
                    case 2:
                        toastr.success('{{trans('partymeister-competitions::backend/entries.status_needs_feedback')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                        break;
                    case 3:
                        toastr.success('{{trans('partymeister-competitions::backend/entries.status_disqualified')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                        break;
                    case 4:
                        toastr.success('{{trans('partymeister-competitions::backend/entries.status_not_preselected')}}', '{{ trans('motor-backend::backend/global.flash.success') }}');
                        break;
                }
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