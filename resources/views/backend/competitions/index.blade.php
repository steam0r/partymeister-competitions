@extends('motor-backend::layouts.backend')

@section('htmlheader_title')
    {{ trans('motor-backend::backend/global.home') }}
@endsection

@section('contentheader_title')
    {{ trans('partymeister-competitions::backend/competitions.competitions') }}
    @if (has_permission('competitions.write'))
	    {!! link_to_route('backend.competitions.create', trans('partymeister-competitions::backend/competitions.new'), [], ['class' => 'pull-right float-right btn btn-sm btn-success']) !!}
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
@endsection

@section('view_scripts')
    <script type="text/javascript">
        $('.delete-record').click(function (e) {
            if (!confirm('{{ trans('motor-backend::backend/global.delete_question') }}')) {
                e.preventDefault();
                return false;
            }
        });

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

        $('.change-competition-upload').click(function (e) {
            e.preventDefault();

            updateRecord(this, $(this).data('record'), {upload_enabled: $(this).data('upload-enabled')}, function (that, results) {
                switchCssClass(that, results.data.upload_enabled, $(that).data('class'), $(that).data('class-alternate'));
                $(that).data('upload-enabled', results.data.upload_enabled ? 0 : 1);
                if (results.data.upload_enabled) {
                    $(that).parent().find('.change-competition-voting').prop('disabled', true);
                } else {
                    $(that).parent().find('.change-competition-voting').prop('disabled', false);
                }
            });
        });


        $('.change-competition-voting').click(function (e) {
            e.preventDefault();

            updateRecord(this, $(this).data('record'), {voting_enabled: $(this).data('voting-enabled')}, function (that, results) {
                switchCssClass(that, results.data.voting_enabled, $(that).data('class'), $(that).data('class-alternate'));
                $(that).data('voting-enabled', results.data.voting_enabled ? 0 : 1);
                if (results.data.voting_enabled) {
                    $(that).parent().find('.change-competition-upload').prop('disabled', true);
                } else {
                    $(that).parent().find('.change-competition-upload').prop('disabled', false);
                }
            });
        });

        var updateRecord = function (that, recordId, data, callback) {
            $.ajax({
                type: 'PATCH',
                url: '{{action('\Partymeister\Competitions\Http\Controllers\Api\CompetitionsController@index')}}/' + recordId + '?api_token=' + apiToken,
                data: data
            }).done(function (results) {
                callback(that, results);
            });
        };

        $('.change-sort-position').blur(function (e) {
            e.preventDefault();

            var data = {};
            data[$(this).data('field')] = $(this).val();

            updateRecord(this, $(this).data('record'), data, function (that, results) {
//                console.log(results);
            });
        });
    </script>
@endsection