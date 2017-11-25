<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="{{$label}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="badge badge-danger" v-if="is_remote">REMOTE</span>
                    @{{title}} by @{{author}}
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
                        @{{ id }}
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/competitions.competition')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ competition.data.name }}
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.running_time')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ running_time }}
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.title')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ title }}
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.author')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ author }}
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.description')}}
                    </dt>
                    <dd class="col-sm-10">
                        <p v-html="nl2br(description)"></p>
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.organizer_description')}}
                    </dt>
                    <dd class="col-sm-10">
                        <p v-html="nl2br(organizer_description)"></p>
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.filesize')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ filesize_human }} (@{{ filesize_bytes }} bytes)
                    </dd>

                    <dt class="col-sm-2">
                        {{trans('partymeister-competitions::backend/entries.platform')}}
                    </dt>
                    <dd class="col-sm-10">
                        @{{ platform }}
                    </dd>
                </dl>

                <div class="row">
                    <div class="col-md-6">
                        <h4>{{trans('partymeister-competitions::backend/entries.author_info')}}</h4>
                        <dl class="row">
                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.name')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ author_name }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.email')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ author_email }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.phone')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ author_phone }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.address')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ author_address }} @{{ author_zip }} @{{ author_city }} @{{ author_country }}
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <h4>{{trans('partymeister-competitions::backend/entries.composer_info')}}</h4>
                        <dl class="row">
                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.name')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ composer_name }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.email')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ composer_email }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.phone')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ composer_phone }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.address')}}
                            </dt>
                            <dd class="col-sm-8">
                                @{{ composer_address }} @{{ composer_zip }} @{{ composer_city }} @{{ composer_country }}
                            </dd>

                            <dt class="col-sm-4">
                                {{trans('partymeister-competitions::backend/entries.composer_gema_cleared')}}
                            </dt>

                            <dd class="col-sm-8">
                                @{{ bool(composer_not_member_of_copyright_collective) }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>