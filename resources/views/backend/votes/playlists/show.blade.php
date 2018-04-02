@extends('motor-backend::layouts.backend')
<div class="loading-overlay"></div>

@section('view_styles')
    @include('partymeister-slides::layouts.partials.slide_fonts')
    <style type="text/css">
        .slidemeister-instance {
            /*zoom: 0.75;*/
            /*zoom: 2;*/
            float: left;
            width: 1920px !important;
            height: 1080px !important;
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
    <button class="btn btn-sm btn-success float-right prizegiving-playlist-save">{{trans('partymeister-competitions::backend/competitions.save_playlist')}}</button>
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
                    @if ($renderSupport)
                        {{--<div id="slidemeister-prizegiving-comingup" class="slidemeister-instance"></div>--}}
                        <div class="render d-none">
                            <div id="slidemeister-prizegiving-comingup-preview" class="slidemeister-instance"></div>
                            <div id="slidemeister-prizegiving-comingup-final" class="slidemeister-instance"></div>
                        </div>
                        <input type="hidden" name="slide[comingup]">
                        <input type="hidden" name="preview[comingup]">
                        <input type="hidden" name="final[comingup]">
                        <input type="hidden" name="type[comingup]" value="comingup">
                        <input type="hidden" name="name[comingup]" value="Prizegiving: Coming up">

                        {{--<div id="slidemeister-prizegiving-now" class="slidemeister-instance"></div>--}}
                        <div class="render d-none">
                            <div id="slidemeister-prizegiving-now-preview" class="slidemeister-instance"></div>
                            <div id="slidemeister-prizegiving-now-final" class="slidemeister-instance"></div>
                        </div>

                        <input type="hidden" name="slide[now]">
                        <input type="hidden" name="preview[now]">
                        <input type="hidden" name="final[now]">
                        <input type="hidden" name="type[now]" value="now">
                        <input type="hidden" name="name[now]" value="Prizegiving: Now">





                        {{--<div id="slidemeister-prizegiving-special-now" class="slidemeister-instance"></div>--}}
                        <div class="render d-none">
                            <div id="slidemeister-prizegiving-special-now-preview" class="slidemeister-instance"></div>
                            <div id="slidemeister-prizegiving-special-now-final" class="slidemeister-instance"></div>
                        </div>

                        <input type="hidden" name="slide[special_now]">
                        <input type="hidden" name="preview[special_now]">
                        <input type="hidden" name="final[special_now]">
                        <input type="hidden" name="type[special_now]" value="now">
                        <input type="hidden" name="name[special_now]" value="Special: Now">

                        {{--<div id="slidemeister-prizegiving-special-slide" class="slidemeister-instance"></div>--}}
                        <div class="render d-none">
                            <div id="slidemeister-prizegiving-special-slide-preview"
                                 class="slidemeister-instance"></div>
                            <div id="slidemeister-prizegiving-special-slide-final" class="slidemeister-instance"></div>
                        </div>

                        <input type="hidden" name="slide[special_slide]">
                        <input type="hidden" name="preview[special_slide]">
                        <input type="hidden" name="final[special_slide]">
                        <input type="hidden" name="type[special_slide]" value="siegmeister_bars">
                        <input type="hidden" name="name[special_slide]" value="Special: Bars">
                        <input type="hidden" name="meta[special_slide]" value="Special: Meta">

                        {{--<div id="slidemeister-prizegiving-special-winners" class="slidemeister-instance"></div>--}}
                        <div class="render d-none">
                            <div id="slidemeister-prizegiving-special-winners-preview"
                                 class="slidemeister-instance"></div>
                            <div id="slidemeister-prizegiving-special-winners-final"
                                 class="slidemeister-instance"></div>
                        </div>

                        <input type="hidden" name="slide[special_winners]">
                        <input type="hidden" name="preview[special_winners]">
                        <input type="hidden" name="final[special_winners]">
                        <input type="hidden" name="type[special_winners]" value="siegmeister_winners">
                        <input type="hidden" name="name[special_winners]" value="Special: Winners">
                    @endif







                    @if ($renderCompetitions)
                        @foreach ($results as $key => $competition)
                            @if ($renderNow)
                                {{--<div id="slidemeister-prizegiving-{{$key}}-now" class="slidemeister-instance"></div>--}}
                                <div class="render d-none">
                                    <div id="slidemeister-prizegiving-{{$key}}-now-preview"
                                         class="slidemeister-instance"></div>
                                    <div id="slidemeister-prizegiving-{{$key}}-now-final"
                                         class="slidemeister-instance"></div>
                                </div>

                                <input type="hidden" name="slide[{{$key}}_now]">
                                <input type="hidden" name="preview[{{$key}}_now]">
                                <input type="hidden" name="final[{{$key}}_now]">
                                <input type="hidden" name="type[{{$key}}_now]" value="now">
                                <input type="hidden" name="name[{{$key}}_now]" value="Competition: {{$key}} Now">
                            @endif

                            @if($renderComments)
                                {{--<div id="slidemeister-prizegiving-{{$key}}-comments" class="slidemeister-instance"></div>--}}
                                <div class="render d-none">
                                    <div id="slidemeister-prizegiving-{{$key}}-comments-preview"
                                         class="slidemeister-instance"></div>
                                    <div id="slidemeister-prizegiving-{{$key}}-comments-final"
                                         class="slidemeister-instance"></div>
                                </div>

                                <input type="hidden" name="slide[{{$key}}_comments]">
                                <input type="hidden" name="preview[{{$key}}_comments]">
                                <input type="hidden" name="final[{{$key}}_comments]">
                                <input type="hidden" name="type[{{$key}}_comments]" value="comments">
                                <input type="hidden" name="name[{{$key}}_comments]" value="Competition: {{$key}} Comments">
                            @endif

                            @if ($renderBars)
                                {{--<div id="slidemeister-prizegiving-{{$key}}-slide" class="slidemeister-instance"></div>--}}
                                <div class="render d-none">
                                    {{--<div id="slidemeister-prizegiving-{{$key}}-slide-preview"--}}
                                         {{--class="slidemeister-instance"></div>--}}
                                    <div id="slidemeister-prizegiving-{{$key}}-slide-final"
                                         class="slidemeister-instance"></div>
                                </div>

                                <input type="hidden" name="slide[{{$key}}_slide]">
                                <input type="hidden" name="preview[{{$key}}_slide]">
                                <input type="hidden" name="final[{{$key}}_slide]">
                                <input type="hidden" name="type[{{$key}}_slide]" value="siegmeister_bars">
                                <input type="hidden" name="name[{{$key}}_slide]" value="Competition: {{$key}} Bars">
                                <input type="hidden" name="meta[{{$key}}_slide]" value="Competition: {{$key}} Meta">




                                {{--<div id="slidemeister-prizegiving-{{$key}}-winners" class="slidemeister-instance"></div>--}}
                                <div class="render d-none">
                                    {{--<div id="slidemeister-prizegiving-{{$key}}-winners-preview"--}}
                                         {{--class="slidemeister-instance"></div>--}}
                                    <div id="slidemeister-prizegiving-{{$key}}-winners-final"
                                         class="slidemeister-instance"></div>
                                </div>

                                <input type="hidden" name="slide[{{$key}}_winners]">
                                <input type="hidden" name="preview[{{$key}}_winners]">
                                <input type="hidden" name="final[{{$key}}_winners]">
                                <input type="hidden" name="type[{{$key}}_winners]" value="siegmeister_winners">
                                <input type="hidden" name="name[{{$key}}_winners]" value="Competition: {{$key}} Winners">
                            @endif
                        @endforeach
                    @endif

                    @if($renderSupport)
                        {{--<div id="slidemeister-prizegiving-end" class="slidemeister-instance"></div>--}}
                        <div class="render d-none">
                            <div id="slidemeister-prizegiving-end-preview" class="slidemeister-instance"></div>
                            <div id="slidemeister-prizegiving-end-final" class="slidemeister-instance"></div>
                        </div>

                        <input type="hidden" name="slide[end]">
                        <input type="hidden" name="preview[end]">
                        <input type="hidden" name="final[end]">
                        <input type="hidden" name="type[end]" value="end">
                        <input type="hidden" name="name[end]" value="Prizegiving: End">
                    @endif
                </div>
            </div>
        </form>
    @endif
@endsection

@if (!isset($message))
@section('view_scripts')
    @include('partymeister-slides::layouts.partials.slide_scripts')
    <script>
        $(document).ready(function () {

            var sm = [];
            var preview_slides = [];
            var final_slides = [];

            {{--sm['comingup'] = $('#slidemeister-prizegiving-comingup').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['comingup'].data.load({!! $comingupTemplate->definitions !!}, {--}}
                    {{--'competition': 'PRIZEGIVING',--}}
                    {{--'headline': 'COMING UP'--}}
                    {{--}, false, true);--}}

                    @if ($renderSupport)
                preview_slides['comingup'] = $('#slidemeister-prizegiving-comingup-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);
            preview_slides['comingup'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'COMING UP'
            }, false, true);

            final_slides['comingup'] = $('#slidemeister-prizegiving-comingup-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['comingup'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'COMING UP'
            }, false, true);

            {{--sm['now'] = $('#slidemeister-prizegiving-now').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['now'].data.load({!! $comingupTemplate->definitions !!}, {--}}
                    {{--'competition': 'PRIZEGIVING',--}}
                    {{--'headline': 'NOW'--}}
                    {{--}, false, true);--}}

                preview_slides['now'] = $('#slidemeister-prizegiving-now-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);
            preview_slides['now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'NOW'
            }, false, true);

            final_slides['now'] = $('#slidemeister-prizegiving-now-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'NOW'
            }, false, true);


            {{--sm['special_now'] = $('#slidemeister-prizegiving-special-now').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['special_now'].data.load({!! $comingupTemplate->definitions !!}, {--}}
                    {{--'competition': 'CROWD FAVOURITE',--}}
                    {{--'headline': 'NOW'--}}
                    {{--}, false, true);--}}

                preview_slides['special_now'] = $('#slidemeister-prizegiving-special-now-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);
            preview_slides['special_now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE',
                'headline': 'NOW'
            }, false, true);

            final_slides['special_now'] = $('#slidemeister-prizegiving-special-now-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['special_now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE',
                'headline': 'NOW'
            }, false, true);

            {{--sm['special_slide'] = $('#slidemeister-prizegiving-special-slide').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['special_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
                    {{--'competition': 'CROWD FAVOURITE'--}}
                    {{--}, false, true);--}}
                    {{--sm['special_slide'].data.populatePrizegiving({!! json_encode($specialVotes) !!});--}}

                preview_slides['special_slide'] = $('#slidemeister-prizegiving-special-slide-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);
            preview_slides['special_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE'
            }, false, true);
            preview_slides['special_slide'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, 'meta[special_slide]');

            final_slides['special_slide'] = $('#slidemeister-prizegiving-special-slide-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['special_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE'
            }, false, true);
            final_slides['special_slide'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, 'meta[special_slide]');

            {{--sm['special_winners'] = $('#slidemeister-prizegiving-special-winners').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['special_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
                    {{--'competition': 'CROWD FAVOURITE'--}}
                    {{--}, false, true);--}}
                    {{--sm['special_winners'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, true);--}}

                preview_slides['special_winners'] = $('#slidemeister-prizegiving-special-winners-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);
            preview_slides['special_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE'
            }, false, true);
            preview_slides['special_winners'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, false, true);

            final_slides['special_winners'] = $('#slidemeister-prizegiving-special-winners-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['special_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE'
            }, false, true);
            final_slides['special_winners'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, false, true);
            @endif


                    @if ($renderCompetitions)
                    @foreach ($results as $key => $competition)
                    {{--sm['{{$key}}_now'] = $('#slidemeister-prizegiving-{{$key}}-now').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['{{$key}}_now'].data.load({!! $comingupTemplate->definitions !!}, {--}}
                    {{--'competition': '{!! strtoupper($competition['name']) !!}',--}}
                    {{--'headline': 'NOW'--}}
                    {{--}, false, true);--}}

                    @if($renderNow)
                preview_slides['{{$key}}_now'] = $('#slidemeister-prizegiving-{{$key}}-now-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);
            preview_slides['{{$key}}_now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': '{!! strtoupper($competition['name']) !!}',
                'headline': 'NOW'
            }, false, true);

            final_slides['{{$key}}_now'] = $('#slidemeister-prizegiving-{{$key}}-now-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['{{$key}}_now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': '{!! strtoupper($competition['name']) !!}',
                'headline': 'NOW'
            }, false, true);
            @endif

                    {{--sm['{{$key}}_slide'] = $('#slidemeister-prizegiving-{{$key}}-slide').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['{{$key}}_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
                    {{--'competition': '{{strtoupper($competition['name'])}}'--}}
                    {{--}, false, true);--}}
                    {{--sm['{{$key}}_slide'].data.populatePrizegiving({!! json_encode($competition['entries']) !!});--}}

                    @if($renderBars)
                {{--preview_slides['{{$key}}_slide'] = $('#slidemeister-prizegiving-{{$key}}-slide-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--preview_slides['{{$key}}_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
                {{--'competition': '{{strtoupper($competition['name'])}}'--}}
            {{--}, false, true);--}}
            {{--preview_slides['{{$key}}_slide'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, 'meta[{{$key}}_slide]');--}}

            final_slides['{{$key}}_slide'] = $('#slidemeister-prizegiving-{{$key}}-slide-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['{{$key}}_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': '{{strtoupper($competition['name'])}}'
            }, false, true);
            final_slides['{{$key}}_slide'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, 'meta[{{$key}}_slide]');

                    {{--sm['{{$key}}_winners'] = $('#slidemeister-prizegiving-{{$key}}-winners').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['{{$key}}_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
                    {{--'competition': '{{strtoupper($competition['name'])}}'--}}
                    {{--}, false, true);--}}
                    {{--sm['{{$key}}_winners'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, true);--}}

                {{--preview_slides['{{$key}}_winners'] = $('#slidemeister-prizegiving-{{$key}}-winners-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
            {{--preview_slides['{{$key}}_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {--}}
                {{--'competition': '{{strtoupper($competition['name'])}}'--}}
            {{--}, false, true);--}}
            {{--preview_slides['{{$key}}_winners'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, true);--}}

            final_slides['{{$key}}_winners'] = $('#slidemeister-prizegiving-{{$key}}-winners-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['{{$key}}_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': '{{strtoupper($competition['name'])}}'
            }, false, true);
            final_slides['{{$key}}_winners'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, '', true);
            @endif

                    {{--sm['{{$key}}_comments'] = $('#slidemeister-prizegiving-{{$key}}-comments').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['{{$key}}_comments'].data.load({!! $commentsTemplate->definitions !!}, {--}}
                    {{--'body': '{!! addslashes($comments[$key]) !!}'--}}
                    {{--}, false, true);--}}

                    @if ($renderComments)
                preview_slides['{{$key}}_comments'] = $('#slidemeister-prizegiving-{{$key}}-comments-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);
            preview_slides['{{$key}}_comments'].data.load({!! $commentsTemplate->definitions !!}, {
                'body': '{!! addslashes($comments[$key]) !!}'
            }, false, true);

            final_slides['{{$key}}_comments'] = $('#slidemeister-prizegiving-{{$key}}-comments-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['{{$key}}_comments'].data.load({!! $commentsTemplate->definitions !!}, {
                'body': '{!! addslashes($comments[$key]) !!}'
            }, false, true);
            @endif
                    @endforeach
                    @endif

                    {{--sm['end'] = $('#slidemeister-prizegiving-end').slidemeister('#slidemeister-properties', slidemeisterProperties);--}}
                    {{--sm['end'].data.load({!! $endTemplate->definitions !!}, {--}}
                    {{--'competition': 'PRIZEGIVING',--}}
                    {{--'headline': 'END'--}}
                    {{--}, false, true);--}}

                    @if($renderSupport)
                preview_slides['end'] = $('#slidemeister-prizegiving-end-preview').slidemeister('#slidemeister-properties', slidemeisterProperties);
            preview_slides['end'].data.load({!! $endTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'END'
            }, false, true);

            final_slides['end'] = $('#slidemeister-prizegiving-end-final').slidemeister('#slidemeister-properties', slidemeisterProperties);
            final_slides['end'].data.load({!! $endTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'END'
            }, false, true);
            @endif


            $('.render').removeClass('d-none');


            $('.prizegiving-playlist-save').on('click', function (e) {

                e.preventDefault();

                $('.loading-overlay').addClass('loading');
                $('.render').removeClass('d-none');

                var tasks = [];
                Object.keys(final_slides).forEach(function (key) {
                    $('input[name="slide[' + key + ']"]').val(JSON.stringify(final_slides[key].data.save(true)));
                    // $('input[name="final[' + key + ']"]').val(JSON.stringify(final_slides[key].data.save(true)));

                    tasks.push(final_slides[key].data.export('final', key));
                    // tasks.push(preview_slides[key].data.export('preview', key));

                });


                window.setTimeout(function () {
                    workMyCollection(tasks)
                        .then(() => {
                            for (let r of final) {
                                $('input[name="' + r[0] + '[' + r[1] + ']"]').val(r[2]);
                            }
                            $('form#prizegiving-playlist-save').submit();
                        });
                }, 1000);

                return;
            });

            function asyncFunc(e) {
                return new Promise((resolve, reject) => {
                    setTimeout(() => resolve(e), e * 1000);
                });
            }

            let final = [];

            function workMyCollection(arr) {
                return arr.reduce((promise, item) => {
                    return promise
                        .then((result) => {
                            // console.log(result);
                            // console.log(`item ${item}`);
                            return asyncFunc(item).then(result => final.push(result));
                        })
                        .catch(console.error);
                }, Promise.resolve());
            }

        });
    </script>
@append
@endif