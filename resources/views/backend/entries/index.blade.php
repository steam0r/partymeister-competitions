@extends('motor-backend::layouts.backend')

@section('htmlheader_title')
    {{ trans('motor-backend::backend/global.home') }}
@endsection

@section('contentheader_title')
    {{ trans('partymeister-competitions::backend/entries.entries') }}
    @if (has_permission('entries.write'))
        {!! link_to_route('backend.entries.create', trans('partymeister-competitions::backend/entries.new'), [], ['class' => 'pull-right btn btn-sm btn-success']) !!}
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
    @include('partymeister-competitions::layouts.partials.entry_modal', ['id' => 'entry-modal', 'label' => 'Entry modal window' ])
@endsection
@section('view_scripts')
    <script type="text/javascript">
        var app = false;
        $('.delete-record').click(function (e) {
            if (!confirm('{{ trans('motor-backend::backend/global.delete_question') }}')) {
                e.preventDefault();
                return false;
            }
        });
        $('.show-entry-description').click(function (e) {
            $.ajax('{{action('\Partymeister\Competitions\Http\Controllers\Api\EntriesController@index')}}/' + $(this).data('id') + '?api_token={{Auth::user()->api_token}}')
                .done(function (results) {

                    if (app === false) {
                        app = new window.Vue({
                            el: '#entry-modal',
                            data: {
                                entry: results.data
                            },
                            methods: {
                                nl2br: function(string) {
                                    return (string + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br>$2');
                                },
                                bool: function(value) {
                                    if (value == 0) {
                                        return '{{ trans('motor-backend::backend/global.no') }}';
                                    } else {
                                        return '{{ trans('motor-backend::backend/global.yes') }}';
                                    }
                                }
                            }
                        });
                    } else {
                        app.entry = results.data;
                        app.$forceUpdate();
                    }
                    $('#entry-modal').modal('show')
                });
            e.preventDefault();
        });
    </script>
@endsection
