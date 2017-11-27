<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="{{$label}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="badge badge-danger" v-if="entry.is_remote">REMOTE</span>
                    @{{entry.title}} by @{{entry.author}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-2">
                        ID
                    </dt>
                    <dd class="col-sm-10">
                        @{{ entry.id }}
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/competitions.competition')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ entry.competition.data.name }}
                    </dd>

                    <template v-if="entry.competition.data.competition_type.data.has_running_time">
                        <dt class="col-sm-2">
                            {{trans('partymeister-competitions::backend/entries.running_time')}}
                        </dt>
                        <dd class="col-sm-10">
                            @{{ entry.running_time }}
                        </dd>
                    </template>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.title')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ entry.title }}
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.author')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ entry.author }}
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.description')}}
                    </dt>
                    <dd class="col-sm-10">
                        <p v-html="nl2br(entry.description)"></p>
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.organizer_description')}}
                    </dt>
                    <dd class="col-sm-10">
                        <p v-html="nl2br(entry.organizer_description)"></p>
                    </dd>

                    <template v-if="entry.competition.data.competition_type.data.has_filesize">
                        <dt class="col-sm-2">
                            {{trans('partymeister-competitions::backend/entries.filesize')}}
                        </dt>
                        <dd class="col-sm-10">
                            @{{ entry.filesize_human }} (@{{ entry.filesize_bytes }} bytes)
                        </dd>
                    </template>

                    <template v-if="entry.competition.data.competition_type.data.has_platform">
                        <dt class="col-sm-2">
                            {{trans('partymeister-competitions::backend/entries.platform')}}
                        </dt>
                        <dd class="col-sm-10">
                            @{{ entry.platform }}
                        </dd>
                    </template>
                </dl>

                <div class="row clearfix">
                    <template v-if="entry.screenshot">
                        <div class="col-md-4">
                            <h5>{{trans('partymeister-competitions::backend/entries.screenshot')}}</h5>
                            <a data-caption="{{trans('partymeister-competitions::backend/entries.screenshot')}}" data-fancybox="gallery" :href="entry.screenshot.data.url"><img class="img-thumbnail" :src="entry.screenshot.data.url"/></a>
                        </div>
                    </template>
                    {{--<template v-if="entry.video">--}}
                        {{--<div class="col-md-6">--}}
                            {{--<h5>{{trans('partymeister-competitions::backend/entries.video')}}</h5>--}}
                            {{--<video style="width:100%;height:100%;" controls="controls" width="100%" height="100%" :src="entry.video.data.url"></video>--}}
                        {{--</div>--}}
                    {{--</template>--}}
                    {{--<div class="clearfix"></div>--}}
                </div>
                <template v-if="entry.work_stages">
                    <h5>{{trans('partymeister-competitions::backend/entries.work_stages')}}</h5>
                    <div class="row">
                        <div class="col-md-3" v-for="(work_stage, index) in entry.work_stages.data">
                            <a data-caption="{{trans('partymeister-competitions::backend/entries.work_stage')}}" data-fancybox="gallery" :href="work_stage.url"><img class="img-thumbnail" :src="work_stage.url"/></a>
                        </div>
                    </div>
                </template>

                <div class="row">
                    <div class="col-md-6">
                        <h4>{{trans('partymeister-competitions::backend/entries.author_info')}}</h4>
                        <dl class="row">
                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.name')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ entry.author_name }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.email')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ entry.author_email }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.phone')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ entry.author_phone }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.address')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ entry.author_address }} @{{ entry.author_zip }} @{{ entry.author_city }} @{{ entry.author_country }}
                            </dd>
                        </dl>
                    </div>
                    <template v-if="entry.competition.data.competition_type.data.has_composer">
                    <div class="col-md-6">
                        <h4>{{trans('partymeister-competitions::backend/entries.composer_info')}}</h4>
                        <dl class="row">
                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.name')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ entry.composer_name }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.email')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ entry.composer_email }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.phone')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ entry.composer_phone }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.address')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ entry.composer_address }} @{{ entry.composer_zip }} @{{ entry.composer_city }} @{{ entry.composer_country }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.composer_gema_cleared')}}
                            </dt>

                            <dd class="col-sm-8">
                                @{{ bool(entry.composer_not_member_of_copyright_collective) }}
                            </dd>
                        </dl>
                    </div>
                    </template>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>