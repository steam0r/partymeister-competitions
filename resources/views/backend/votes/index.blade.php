@extends('motor-backend::layouts.backend')

@section('htmlheader_title')
    {{ trans('motor-backend::backend/global.home') }}
@endsection

@section('contentheader_title')
    {{ trans('partymeister-competitions::backend/votes.votes') }}
    @if (has_permission('votes.write'))
        {!! link_to_route('backend.competition_prizes.create', trans('partymeister-competitions::backend/competition_prizes.edit'), [], ['class' => 'float-right btn btn-sm btn-success']) !!}
        {!! link_to_route('backend.votes.create', trans('partymeister-competitions::backend/votes.edit'), [], ['class' => 'float-right btn btn-sm btn-success']) !!}
        <div class="dropdown float-right">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{trans('partymeister-competitions::backend/competition_prizes.downloads')}}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                {!! link_to_route('backend.competition_prizes.export.receipt', trans('partymeister-competitions::backend/competition_prizes.empty_receipt'), [], ['class' => 'dropdown-item']) !!}
                {!! link_to_route('backend.competition_prizes.export.prizesheet', trans('partymeister-competitions::backend/competition_prizes.prizesheet'), ['prizesheet' => true, 'receipt' => true], ['class' => 'dropdown-item']) !!}
                {!! link_to_route('backend.competition_prizes.export.prizesheet', trans('partymeister-competitions::backend/competition_prizes.prizesheet_only'), ['prizesheet' => true], ['class' => 'dropdown-item']) !!}
                {!! link_to_route('backend.competition_prizes.export.prizesheet', trans('partymeister-competitions::backend/competition_prizes.receipts_only'), ['receipt' => true], ['class' => 'dropdown-item']) !!}
            </div>
        </div>
    @endif
@endsection

@section('main-content')
    <div class="@boxWrapper">
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
                        <div class="col-md-6">
                            {{$entry['author']}}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
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
    </script>
@endsection