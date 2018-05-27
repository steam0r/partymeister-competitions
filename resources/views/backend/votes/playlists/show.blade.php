@extends('motor-backend::layouts.backend')
<div class="loader loader-default"
     data-text="&hearts; Generating slide previews and hiding the ugliness &hearts;"></div>

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
                    <div id="slidemeister-prizegiving-comingup" class="slidemeister-instance"></div>
                    <input type="hidden" name="slide[comingup]">
                    <input type="hidden" name="preview[comingup]">
                    <input type="hidden" name="final[comingup]">
                    <input type="hidden" name="cached_html_preview[comingup]">
                    <input type="hidden" name="cached_html_final[comingup]">
                    <input type="hidden" name="type[comingup]" value="comingup">
                    <input type="hidden" name="name[comingup]" value="Prizegiving: Coming up">

                    <div id="slidemeister-prizegiving-now" class="slidemeister-instance"></div>

                    <input type="hidden" name="slide[now]">
                    <input type="hidden" name="preview[now]">
                    <input type="hidden" name="final[now]">
                    <input type="hidden" name="cached_html_preview[now]">
                    <input type="hidden" name="cached_html_final[now]">
                    <input type="hidden" name="type[now]" value="now">
                    <input type="hidden" name="name[now]" value="Prizegiving: Now">


                    <div id="slidemeister-prizegiving-special-now" class="slidemeister-instance"></div>

                    <input type="hidden" name="slide[special_now]">
                    <input type="hidden" name="preview[special_now]">
                    <input type="hidden" name="final[special_now]">
                    <input type="hidden" name="cached_html_preview[special_now]">
                    <input type="hidden" name="cached_html_final[special_now]">
                    <input type="hidden" name="type[special_now]" value="now">
                    <input type="hidden" name="name[special_now]" value="Special: Now">

                    <div id="slidemeister-prizegiving-special-slide" class="slidemeister-instance"></div>

                    <input type="hidden" name="slide[special_slide]">
                    <input type="hidden" name="preview[special_slide]">
                    <input type="hidden" name="final[special_slide]">
                    <input type="hidden" name="cached_html_preview[special_slide]">
                    <input type="hidden" name="cached_html_final[special_slide]">
                    <input type="hidden" name="type[special_slide]" value="siegmeister_bars">
                    <input type="hidden" name="name[special_slide]" value="Special: Bars">
                    <input type="hidden" name="meta[special_slide]" value="Special: Meta">

                    <div id="slidemeister-prizegiving-special-winners" class="slidemeister-instance"></div>

                    <input type="hidden" name="slide[special_winners]">
                    <input type="hidden" name="preview[special_winners]">
                    <input type="hidden" name="final[special_winners]">
                    <input type="hidden" name="cached_html_preview[special_winners]">
                    <input type="hidden" name="cached_html_final[special_winners]">
                    <input type="hidden" name="type[special_winners]" value="siegmeister_winners">
                    <input type="hidden" name="name[special_winners]" value="Special: Winners">


                    @foreach ($results as $key => $competition)
                        <div id="slidemeister-prizegiving-{{$key}}-now" class="slidemeister-instance"></div>

                        <input type="hidden" name="slide[{{$key}}_now]">
                        <input type="hidden" name="preview[{{$key}}_now]">
                        <input type="hidden" name="final[{{$key}}_now]">
                        <input type="hidden" name="cached_html_preview[{{$key}}_now]">
                        <input type="hidden" name="cached_html_final[{{$key}}_now]">
                        <input type="hidden" name="type[{{$key}}_now]" value="now">
                        <input type="hidden" name="name[{{$key}}_now]" value="Competition: {{$key}} Now">

                        <div id="slidemeister-prizegiving-{{$key}}-comments"
                             class="slidemeister-instance"></div>

                        <input type="hidden" name="slide[{{$key}}_comments]">
                        <input type="hidden" name="preview[{{$key}}_comments]">
                        <input type="hidden" name="final[{{$key}}_comments]">
                        <input type="hidden" name="cached_html_preview[{{$key}}_comments]">
                        <input type="hidden" name="cached_html_final[{{$key}}_comments]">
                        <input type="hidden" name="type[{{$key}}_comments]" value="comments">
                        <input type="hidden" name="name[{{$key}}_comments]"
                               value="Competition: {{$key}} Comments">

                        <div id="slidemeister-prizegiving-{{$key}}-slide" class="slidemeister-instance"></div>

                        <input type="hidden" name="slide[{{$key}}_slide]">
                        <input type="hidden" name="preview[{{$key}}_slide]">
                        <input type="hidden" name="final[{{$key}}_slide]">
                        <input type="hidden" name="cached_html_preview[{{$key}}_slide]">
                        <input type="hidden" name="cached_html_final[{{$key}}_slide]">
                        <input type="hidden" name="type[{{$key}}_slide]" value="siegmeister_bars">
                        <input type="hidden" name="name[{{$key}}_slide]" value="Competition: {{$key}} Bars">
                        <input type="hidden" name="meta[{{$key}}_slide]" value="Competition: {{$key}} Meta">




                        <div id="slidemeister-prizegiving-{{$key}}-winners" class="slidemeister-instance"></div>

                        <input type="hidden" name="slide[{{$key}}_winners]">
                        <input type="hidden" name="preview[{{$key}}_winners]">
                        <input type="hidden" name="final[{{$key}}_winners]">
                        <input type="hidden" name="cached_html_preview[{{$key}}_winners]">
                        <input type="hidden" name="cached_html_final[{{$key}}_winners]">
                        <input type="hidden" name="type[{{$key}}_winners]" value="siegmeister_winners">
                        <input type="hidden" name="name[{{$key}}_winners]"
                               value="Competition: {{$key}} Winners">
                    @endforeach

                    <div id="slidemeister-prizegiving-end" class="slidemeister-instance"></div>

                    <input type="hidden" name="slide[end]">
                    <input type="hidden" name="preview[end]">
                    <input type="hidden" name="final[end]">
                    <input type="hidden" name="cached_html_preview[end]">
                    <input type="hidden" name="cached_html_final[end]">
                    <input type="hidden" name="type[end]" value="end">
                    <input type="hidden" name="name[end]" value="Prizegiving: End">
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

            sm['comingup'] = $('#slidemeister-prizegiving-comingup').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['comingup'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'COMING UP'
            }, false, true);

            sm['now'] = $('#slidemeister-prizegiving-now').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'NOW'
            }, false, true);

            sm['special_now'] = $('#slidemeister-prizegiving-special-now').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['special_now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE',
                'headline': 'NOW'
            }, false, true);

            sm['special_slide'] = $('#slidemeister-prizegiving-special-slide').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['special_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE'
            }, false, true);
            sm['special_slide'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, 'meta[special_slide]');

            sm['special_winners'] = $('#slidemeister-prizegiving-special-winners').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['special_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': 'CROWD FAVOURITE'
            }, false, true);
            sm['special_winners'].data.populatePrizegiving({!! json_encode($specialVotes) !!}, '', true);

            @foreach ($results as $key => $competition)
                sm['{{$key}}_now'] = $('#slidemeister-prizegiving-{{$key}}-now').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['{{$key}}_now'].data.load({!! $comingupTemplate->definitions !!}, {
                'competition': '{!! strtoupper($competition['name']) !!}',
                'headline': 'NOW'
            }, false, true);

            sm['{{$key}}_slide'] = $('#slidemeister-prizegiving-{{$key}}-slide').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['{{$key}}_slide'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': '{{strtoupper($competition['name'])}}'
            }, false, true);
            sm['{{$key}}_slide'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, 'meta[{{$key}}_slide]');

            sm['{{$key}}_winners'] = $('#slidemeister-prizegiving-{{$key}}-winners').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['{{$key}}_winners'].data.load({!! $prizegivingTemplate->definitions !!}, {
                'competition': '{{strtoupper($competition['name'])}}'
            }, false, true);
            sm['{{$key}}_winners'].data.populatePrizegiving({!! json_encode($competition['entries']) !!}, '', true);

            sm['{{$key}}_comments'] = $('#slidemeister-prizegiving-{{$key}}-comments').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['{{$key}}_comments'].data.load({!! $commentsTemplate->definitions !!}, {
                'body': '{!! addslashes($comments[$key]) !!}'
            }, false, true);

            @endforeach

                sm['end'] = $('#slidemeister-prizegiving-end').slidemeister('#slidemeister-properties', slidemeisterProperties);
            sm['end'].data.load({!! $endTemplate->definitions !!}, {
                'competition': 'PRIZEGIVING',
                'headline': 'END'
            }, false, true);

            $('.prizegiving-playlist-save').prop('disabled', false);


            $('.prizegiving-playlist-save').on('click', function (e) {

                e.preventDefault();

                $('.loader').addClass('is-active');


                var tasks = [];

                sm['comingup'].data.export('preview', 'comingup').then(result => {
                    Object.keys(sm).forEach(function (key) {
                        console.log('Processing ' + key);
                        $('input[name="slide[' + key + ']"]').val(JSON.stringify(sm[key].data.save(true)));

                        tasks.push(
                            sm[key].data.export('preview', key).then(result => {
                                console.log('Rendering preview of ' + key);
                                $('input[name="preview[' + key + ']"]').val(result[2]);
                                $('input[name="cached_html_preview[' + key + ']"]').val($(sm[key].data.getTargetElement()).html());


                                return sm[key].data.export('final', key).then(result => {
                                    console.log('Rendering final of ' + key);
                                    $('input[name="final[' + key + ']"]').val(result[2]);
                                    $('input[name="cached_html_final[' + key + ']"]').val($(sm[key].data.getTargetElement()).html());
                                })

                            })
                        );

                    });

                    window.setTimeout(function () {
                        // cache embedded fonts
                        workMyCollection(tasks)
                            .then(() => {
                                $('form#prizegiving-playlist-save').submit();
                            });
                    }, 1000);
                });
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
                            return asyncFunc(item).then(result => final.push(result));
                        })
                        .catch(console.error);
                }, Promise.resolve());
            }

        });
    </script>
@append
@endif