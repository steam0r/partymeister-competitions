@extends('motor-backend::layouts.backend')
@section('view_styles')
    @include('partymeister-slides::layouts.partials.slide_fonts')
    <style type="text/css">
        .slidemeister-instance {
            zoom: 1;
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
    <button class="btn btn-sm btn-success float-right prizegiving-playlist-save"
            disabled>{{trans('partymeister-competitions::backend/competitions.save_playlist')}}</button>
    {!! link_to_route('backend.competitions.index', trans('motor-backend::backend/global.back'), [], ['class' => 'float-right btn btn-sm btn-danger']) !!}
@endsection

@section('main-content')
    @if (isset($message))
        <div class="alert alert-warning">
            {{$message}}
        </div>
    @else
        <form id="prizegiving-playlist-save"
              action="{{route('backend.votes.playlist.store')}}" method="POST">
            @csrf
            <div class="@boxWrapper box-primary" style="margin-bottom: 0;">
                <div class="@boxBody">

                    <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-comingup'"
                                                  id="slidemeister-prizegiving-comingup"
                                                  class="slidemeister-instance"></partymeister-slides-elements>
                    <input type="hidden" name="slide[comingup]">
                    <input type="hidden" name="cached_html_preview[comingup]">
                    <input type="hidden" name="cached_html_final[comingup]">
                    <input type="hidden" name="type[comingup]" value="comingup">
                    <input type="hidden" name="name[comingup]" value="Prizegiving: Coming up">

                    <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-now'"
                                                  id="slidemeister-prizegiving-now"
                                                  class="slidemeister-instance"></partymeister-slides-elements>

                    <input type="hidden" name="slide[now]">
                    <input type="hidden" name="cached_html_preview[now]">
                    <input type="hidden" name="cached_html_final[now]">
                    <input type="hidden" name="type[now]" value="now">
                    <input type="hidden" name="name[now]" value="Prizegiving: Now">

                    @foreach ($results as $key => $competition)
                        <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-{{$key}}-now'"
                                                      id="slidemeister-prizegiving-{{$key}}-now"
                                                      class="slidemeister-instance"></partymeister-slides-elements>

                        <input type="hidden" name="slide[{{$key}}_now]">
                        <input type="hidden" name="cached_html_preview[{{$key}}_now]">
                        <input type="hidden" name="cached_html_final[{{$key}}_now]">
                        <input type="hidden" name="type[{{$key}}_now]" value="now">
                        <input type="hidden" name="name[{{$key}}_now]" value="Competition: {{$key}} Now">

                        @if ($competition['has_comment'])
                            <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-{{$key}}-comments'"
                                                          id="slidemeister-prizegiving-{{$key}}-comments"
                                                          class="slidemeister-instance"></partymeister-slides-elements>

                        <input type="hidden" name="slide[{{$key}}_comments]">
                        <input type="hidden" name="cached_html_preview[{{$key}}_comments]">
                        <input type="hidden" name="cached_html_final[{{$key}}_comments]">
                        <input type="hidden" name="type[{{$key}}_comments]" value="comments">
                        <input type="hidden" name="name[{{$key}}_comments]"
                               value="Competition: {{$key}} Comments">
                        @endif

                        <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-{{$key}}-slide'"
                                                      id="slidemeister-prizegiving-{{$key}}-slide"
                                                      class="slidemeister-instance"></partymeister-slides-elements>

                        <input type="hidden" name="slide[{{$key}}_slide]">
                        <input type="hidden" name="cached_html_preview[{{$key}}_slide]">
                        <input type="hidden" name="cached_html_final[{{$key}}_slide]">
                        <input type="hidden" name="type[{{$key}}_slide]" value="siegmeister_bars">
                        <input type="hidden" name="name[{{$key}}_slide]" value="Competition: {{$key}} Bars">
                        <input type="hidden" name="meta[{{$key}}_slide]" value="Competition: {{$key}} Meta">

                        <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-{{$key}}-winners'"
                                                      id="slidemeister-prizegiving-{{$key}}-winners"
                                                      class="slidemeister-instance"></partymeister-slides-elements>

                        <input type="hidden" name="slide[{{$key}}_winners]">
                        <input type="hidden" name="cached_html_preview[{{$key}}_winners]">
                        <input type="hidden" name="cached_html_final[{{$key}}_winners]">
                        <input type="hidden" name="type[{{$key}}_winners]" value="siegmeister_winners">
                        <input type="hidden" name="name[{{$key}}_winners]"
                               value="Competition: {{$key}} Winners">
                    @endforeach

                    @if (count($specialVotes) > 0)

                        <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-special-now'"
                                                      id="slidemeister-prizegiving-special-now"
                                                      class="slidemeister-instance"></partymeister-slides-elements>

                    <input type="hidden" name="slide[special_now]">
                    <input type="hidden" name="cached_html_preview[special_now]">
                    <input type="hidden" name="cached_html_final[special_now]">
                    <input type="hidden" name="type[special_now]" value="now">
                    <input type="hidden" name="name[special_now]" value="Special: Now">

                        <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-special-slide'"
                                                      id="slidemeister-prizegiving-special-slide"
                                                      class="slidemeister-instance"></partymeister-slides-elements>

                    <input type="hidden" name="slide[special_slide]">
                    <input type="hidden" name="cached_html_preview[special_slide]">
                    <input type="hidden" name="cached_html_final[special_slide]">
                    <input type="hidden" name="type[special_slide]" value="siegmeister_bars">
                    <input type="hidden" name="name[special_slide]" value="Special: Bars">
                    <input type="hidden" name="meta[special_slide]" value="Special: Meta">

                        <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-special-winners'"
                                                      id="slidemeister-prizegiving-special-winners"
                                                      class="slidemeister-instance"></partymeister-slides-elements>

                    <input type="hidden" name="slide[special_winners]">
                    <input type="hidden" name="cached_html_preview[special_winners]">
                    <input type="hidden" name="cached_html_final[special_winners]">
                    <input type="hidden" name="type[special_winners]" value="siegmeister_winners">
                    <input type="hidden" name="name[special_winners]" value="Special: Winners">
                    @endif

                    <partymeister-slides-elements :readonly="true" :name="'slidemeister-prizegiving-end'"
                                                  id="slidemeister-prizegiving-end"
                                                  class="slidemeister-instance"></partymeister-slides-elements>

                    <input type="hidden" name="slide[end]">
                    <input type="hidden" name="cached_html_preview[end]">
                    <input type="hidden" name="cached_html_final[end]">
                    <input type="hidden" name="type[end]" value="end">
                    <input type="hidden" name="name[end]" value="Prizegiving: End">
                </div>
            </div>
        </form>
    @endif
    <div class="loader loader-default"
         data-text="&hearts; {{ trans('partymeister-slides::backend/slides.generating')}} &hearts;"></div>
@endsection

@if (!isset($message))
@section('view_scripts')
    @include('partymeister-slides::layouts.partials.slide_scripts')
    <script>
        $(document).ready(function () {
            Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                name: 'slidemeister-prizegiving-comingup',
                elements: JSON.parse('{!! addslashes($comingupTemplate->definitions) !!}'),
                type: 'prizegiving-support',

                replacements: {headline: 'Coming up', body: 'Prizegiving' },
            });

            Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                name: 'slidemeister-prizegiving-now',
                elements: JSON.parse('{!! addslashes($comingupTemplate->definitions) !!}'),
                type: 'prizegiving-support',
                replacements: {headline: 'Now', body: 'Prizegiving' },
            });

            Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                name: 'slidemeister-prizegiving-end',
                elements: JSON.parse('{!! addslashes($endTemplate->definitions) !!}'),
                type: 'prizegiving-support',
                replacements: {headline: 'End', body: 'Prizegiving' },
            });

            @foreach ($results as $key => $competition)
                Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                    name: 'slidemeister-prizegiving-{{$key}}-now',
                    elements: JSON.parse('{!! addslashes($comingupTemplate->definitions) !!}'),
                    type: 'prizegiving-support',
                    replacements: {headline: 'Now', body: '{{$competition['name']}}' },
                });
                @if ($competition['has_comment'])
                    Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                        name: 'slidemeister-prizegiving-{{$key}}-comments',
                        elements: JSON.parse('{!! addslashes($commentsTemplate->definitions) !!}'),
                        type: 'prizegiving-support',
                        replacements: {headline: '{{$competition['name']}}', body: '{!! addslashes($comments[$key]) !!}' },
                    });
                @endif

                Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                    name: 'slidemeister-prizegiving-{{$key}}-slide',
                    elements: JSON.parse('{!! addslashes($prizegivingTemplate->definitions) !!}'),
                    type: 'prizegiving-slide',
                    replacements: {headline: '{{$competition["name"]}}', rows: {!! json_encode($competition['entries']) !!} },
                });

                Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                    name: 'slidemeister-prizegiving-{{$key}}-winners',
                    elements: JSON.parse('{!! addslashes($prizegivingTemplate->definitions) !!}'),
                    type: 'prizegiving-winners',
                    replacements: {headline: '{{$competition["name"]}}', rows: {!! json_encode($competition['entries']) !!} },
                });
            @endforeach
            @if (count($specialVotes) > 0)
            Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                name: 'slidemeister-prizegiving-special-now',
                elements: JSON.parse('{!! addslashes($comingupTemplate->definitions) !!}'),
                type: 'prizegiving-support',
                replacements: {headline: 'Now', body: 'Crowd favourite' },
            });

            Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                name: 'slidemeister-prizegiving-special-slide',
                elements: JSON.parse('{!! addslashes($prizegivingTemplate->definitions) !!}'),
                type: 'prizegiving-slide',
                replacements: {headline: 'Crowd favourite', rows: {!! json_encode($specialVotes) !!} },
            });

            Vue.prototype.$eventHub.$emit('partymeister-slides:load-definitions', {
                name: 'slidemeister-prizegiving-special-winners',
                elements: JSON.parse('{!! addslashes($prizegivingTemplate->definitions) !!}'),
                type: 'prizegiving-winners',
                replacements: {headline: 'Crowd favourite', rows: {!! json_encode($specialVotes) !!} },
            });
            @endif

            $('.competition-playlist-save').prop('disabled', false);

            $('.competition-playlist-save').on('click', function (e) {

                $('.loader').addClass('is-active');

                let saveCounter = 0;

                Vue.prototype.$eventHub.$on('partymeister-slides:timetable-finished', () => {
                    if (saveCounter === $('.slidemeister-instance').length) {
                        $('#competition-playlist-save').submit();
                    }
                });

                {{--Vue.prototype.$eventHub.$on('partymeister-slides:receive-definitions', (data) => {--}}
                {{--    if (data.name === 'slidemeister-competition-comingup') {--}}
                {{--        $('input[name="slide[comingup]"]').val(data.definitions);--}}
                {{--        $('input[name="cached_html_preview[comingup]"]').val($('#slidemeister-competition-comingup').html());--}}
                {{--        $('input[name="cached_html_final[comingup]"]').val($('#slidemeister-competition-comingup').html());--}}
                {{--        saveCounter++;--}}
                {{--    }--}}
                {{--    if (data.name === 'slidemeister-competition-now') {--}}
                {{--        $('input[name="slide[now]"]').val(data.definitions);--}}
                {{--        $('input[name="cached_html_preview[now]"]').val($('#slidemeister-competition-now').html());--}}
                {{--        $('input[name="cached_html_final[now]"]').val($('#slidemeister-competition-now').html());--}}
                {{--        saveCounter++;--}}
                {{--    }--}}
                {{--    if (data.name === 'slidemeister-competition-end') {--}}
                {{--        $('input[name="slide[end]"]').val(data.definitions);--}}
                {{--        $('input[name="cached_html_preview[end]"]').val($('#slidemeister-competition-end').html());--}}
                {{--        $('input[name="cached_html_final[end]"]').val($('#slidemeister-competition-end').html());--}}
                {{--        saveCounter++;--}}
                {{--    }--}}
                {{--    if (data.name === 'slidemeister-competition-participants') {--}}
                {{--        $('input[name="slide[participants]"]').val(data.definitions);--}}
                {{--        $('input[name="cached_html_preview[participants]"]').val($('#slidemeister-competition-participants').html());--}}
                {{--        $('input[name="cached_html_final[participants]"]').val($('#slidemeister-competition-participants').html());--}}
                {{--        saveCounter++;--}}
                {{--    }--}}
                {{--    @foreach($entries as $index => $entry)--}}
                {{--    if (data.name === 'slidemeister-competition-entry-{{$entry['id']}}') {--}}
                {{--        $('input[name="slide[entry_{{$entry['id']}}]"]').val(data.definitions);--}}
                {{--        $('input[name="cached_html_preview[entry_{{$entry['id']}}]"]').val($('#slidemeister-competition-entry-{{$entry['id']}}').html());--}}
                {{--        $('input[name="cached_html_final[entry_{{$entry['id']}}]"]').val($('#slidemeister-competition-entry-{{$entry['id']}}').html());--}}
                {{--        saveCounter++;--}}
                {{--    }--}}
                {{--    @endforeach--}}

                {{--    Vue.prototype.$eventHub.$emit('partymeister-slides:timetable-finished');--}}
                {{--});--}}

                {{--Vue.prototype.$eventHub.$emit('partymeister-slides:request-definitions', 'slidemeister-competition-comingup');--}}
                {{--Vue.prototype.$eventHub.$emit('partymeister-slides:request-definitions', 'slidemeister-competition-now');--}}
                {{--Vue.prototype.$eventHub.$emit('partymeister-slides:request-definitions', 'slidemeister-competition-end');--}}
                {{--@if (count($participants) > 0)--}}
                {{--Vue.prototype.$eventHub.$emit('partymeister-slides:request-definitions', 'slidemeister-competition-participants');--}}
                {{--@endif--}}
                {{--@foreach($entries as $index => $entry)--}}
                {{--Vue.prototype.$eventHub.$emit('partymeister-slides:request-definitions', 'slidemeister-competition-entry-{{$entry['id']}}');--}}
                {{--@endforeach--}}
            });


            {{--let sm = [];--}}

            {{--sm['comingup'] = $('#slidemeister-prizegiving-comingup').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['comingup'].data.load({!! $comingupTemplate->definitions !!}, {--}}
            {{--    'competition': 'PRIZEGIVING',--}}
            {{--    'headline': 'COMING UP'--}}
            {{--}, false, true);--}}

            {{--sm['now'] = $('#slidemeister-prizegiving-now').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['now'].data.load({!! $comingupTemplate->definitions !!}, {--}}
            {{--    'competition': 'PRIZEGIVING',--}}
            {{--    'headline': 'NOW'--}}
            {{--}, false, true);--}}

            {{--@foreach ($results as $key => $competition)--}}
            {{--    sm['{{$key}}_now'] = $('#slidemeister-prizegiving-{{$key}}-now').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['{{$key}}_now'].data.load({!! $comingupTemplate->definitions !!}, {--}}
            {{--    'competition': '{!! strtoupper($competition['name']) !!}',--}}
            {{--    'headline': 'NOW'--}}
            {{--}, false, true);--}}

            {{--sm['{{$key}}_slide'] = $('#slidemeister-prizegiving-{{$key}}-slide').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['{{$key}}_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
            {{--    'competition': '{{strtoupper($competition['name'])}}'--}}
            {{--}, false, true);--}}
            {{--sm['{{$key}}_slide'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, 'meta[{{$key}}_slide]');--}}

            {{--sm['{{$key}}_winners'] = $('#slidemeister-prizegiving-{{$key}}-winners').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['{{$key}}_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
            {{--    'competition': '{{strtoupper($competition['name'])}}'--}}
            {{--}, false, true);--}}
            {{--sm['{{$key}}_winners'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, '', true);--}}

            {{--@if ($competition['has_comment'])--}}
            {{--    sm['{{$key}}_comments'] = $('#slidemeister-prizegiving-{{$key}}-comments').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['{{$key}}_comments'].data.load({!! $commentsTemplate->definitions !!}, {--}}
            {{--    'body': '{!! addslashes($comments[$key]) !!}'--}}
            {{--}, false, true);--}}
            {{--@endif--}}

            {{--@endforeach--}}

            {{--@if (count($specialVotes) > 0)--}}
            {{--sm['special_now'] = $('#slidemeister-prizegiving-special-now').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['special_now'].data.load({!! $comingupTemplate->definitions !!}, {--}}
            {{--    'competition': 'CROWD FAVOURITE',--}}
            {{--    'headline': 'NOW'--}}
            {{--}, false, true);--}}

            {{--sm['special_slide'] = $('#slidemeister-prizegiving-special-slide').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['special_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
            {{--    'competition': 'CROWD FAVOURITE'--}}
            {{--}, false, true);--}}
            {{--sm['special_slide'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, 'meta[special_slide]');--}}

            {{--sm['special_winners'] = $('#slidemeister-prizegiving-special-winners').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['special_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
            {{--    'competition': 'CROWD FAVOURITE'--}}
            {{--}, false, true);--}}
            {{--sm['special_winners'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, '', true);--}}
            {{--@endif--}}

            {{--    sm['end'] = $('#slidemeister-prizegiving-end').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--sm['end'].data.load({!! $endTemplate->definitions !!}, {--}}
            {{--    'competition': 'PRIZEGIVING',--}}
            {{--    'headline': 'END'--}}
            {{--}, false, true);--}}

            {{--$('.prizegiving-playlist-save').prop('disabled', false);--}}

            {{--$('.prizegiving-playlist-save').on('click', function (e) {--}}

            {{--    e.preventDefault();--}}

            {{--    $('.loader').addClass('is-active');--}}


            {{--    Object.keys(sm).forEach(function (key) {--}}
            {{--        console.log('Processing ' + key);--}}
            {{--        $('input[name="slide[' + key + ']"]').val(JSON.stringify(sm[key].data.save(true)));--}}
            {{--        $('input[name="cached_html_preview[' + key + ']"]').val($(sm[key].data.getTargetElement()).html());--}}
            {{--        sm[key].data.removePreviewElements();--}}
            {{--        $('input[name="cached_html_final[' + key + ']"]').val($(sm[key].data.getTargetElement()).html());--}}
            {{--        $('form#prizegiving-playlist-save').submit();--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
@append
@endif
