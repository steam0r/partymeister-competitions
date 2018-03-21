@extends('motor-backend::layouts.backend')

@section('view_styles')
    @include('partymeister-slides::layouts.partials.slide_fonts')
    <style type="text/css">
        .slidemeister-instance {
            zoom: 0.75;
            float: left;
            margin-right: 15px;
            margin-bottom: 15px;
        }
    </style>
@append
@section('htmlheader_title')
    {{ trans('motor-backend::backend/global.home') }}
@endsection

@section('contentheader_title')
    {{ trans('partymeister-competitions::backend/competitions.playlist_preview') }}
    {!! link_to_route('backend.competitions.index', trans('motor-backend::backend/global.back'), [], ['class' => 'pull-right btn btn-sm btn-danger']) !!}
@endsection

@section('main-content')
    <div class="@boxWrapper box-primary" style="margin-bottom: 0;">
        <div class="@boxBody">
            <div id="slidemeister-competition-comingup" class="slidemeister-instance"></div>
            @foreach ($videos as $video)
                <div class="slidemeister-instance">
                    <img src="{{$video['preview']}}" style="width: 100%;">
                </div>
            @endforeach
            <div id="slidemeister-competition-now" class="slidemeister-instance"></div>
            @foreach($entries as $entry)
                <div id="slidemeister-entry-{{$entry['id']}}" class="slidemeister-instance"></div>
            @endforeach
            <div id="slidemeister-competition-end" class="slidemeister-instance"></div>
        </div>
    </div>
@endsection

@section('view_scripts')
    @include('partymeister-slides::layouts.partials.slide_scripts')
    <script>
        $(document).ready(function () {
            var sm = [];
            sm['comingup'] = $('#slidemeister-competition-comingup').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['comingup'].data.load({!! $comingupTemplate->definitions !!}, {'competition': '{{strtoupper($competition->name)}}', 'headline': 'COMING UP'}, false, true);
            sm['now'] = $('#slidemeister-competition-now').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['now'].data.load({!! $comingupTemplate->definitions !!}, {'competition': '{{strtoupper($competition->name)}}', 'headline': 'NOW'}, false, true);
            @foreach($entries as $entry)
                sm[{{$entry['id']}}] = $('#slidemeister-entry-{{$entry['id']}}').slidemeister('#slidemeister-properties', slidemeisterProperties);
                sm[{{$entry['id']}}].data.load({!! $entryTemplate->definitions !!}, {!! json_encode($entry) !!}, false, true);
            @endforeach
            sm['end'] = $('#slidemeister-competition-end').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['end'].data.load({!! $endTemplate->definitions !!}, {'competition': '{{strtoupper($competition->name)}}', 'headline': 'END'}, false, true);
        });
    </script>
@append
