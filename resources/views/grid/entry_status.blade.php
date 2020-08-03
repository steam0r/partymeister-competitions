<div class="btn-group" role="group">
    <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="0" data-class="btn-danger" class="change-entry-status btn @defaultButtonSize @if ($record->status == 0)btn-danger @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.0')}}">U</button>
    <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="1" data-class="btn-success" class="change-entry-status btn @defaultButtonSize @if ($record->status == 1)btn-success @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.1')}}">C</button>
    <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="3" data-class="btn-black" class="change-entry-status btn @defaultButtonSize @if ($record->status == 3)btn-black @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.3')}}">D</button>
    <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="4" data-class="btn-black" class="change-entry-status btn @defaultButtonSize @if ($record->status == 4)btn-black @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.4')}}">P</button>
    <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-status="2" data-class="btn-warning" class="change-entry-status btn @defaultButtonSize @if ($record->status == 2)btn-warning @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.2')}}">F</button>
</div>
<button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-class="btn-success" data-class-alternate="btn-danger" data-is-prepared="{{(int)!$record->is_prepared}}" class="change-entry-preparation btn @defaultButtonSize @if ($record->is_prepared == 1)btn-success @else btn-danger @endif" title="{{trans('partymeister-competitions::backend/entries.is_prepared')}}">PREP</button>
<button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-class="btn-danger" data-class-alternate="btn-outline-secondary" data-upload-enabled="{{(int)!$record->upload_enabled}}" class="change-entry-upload btn @defaultButtonSize @if ($record->upload_enabled == 1)btn-danger @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.upload_enabled')}}">UPL</button>
@if ($record->competition->competition_type->has_recordings)
    <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-class="btn-success" data-class-alternate="btn-danger" data-is-recorded="{{(int)!$record->is_recorded}}" class="change-entry-recording btn @defaultButtonSize @if ($record->is_recorded == 1)btn-success @else btn-danger @endif" title="{{trans('partymeister-competitions::backend/entries.is_recorded')}}">REC</button>
@endif
@if ($record->competition->competition_type->has_composer)
    <button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-class="btn-success" data-class-alternate="btn-danger" data-composer-gema="{{(int)!$record->composer_not_member_of_copyright_collective}}" class="change-entry-gema btn @defaultButtonSize @if ($record->composer_not_member_of_copyright_collective == 1)btn-success @else btn-danger @endif" title="{{trans('partymeister-competitions::backend/entries.composer_not_member_of_copyright_collective')}}">GEMA</button>
@endif

@if (!$record->competition->upload_enabled && !$record->competition->voting_enabled && $record->status == 1)
<button type="button" data-toggle="tooltip" data-placement="top" data-entry="{{$record->id}}" data-class="btn-success" data-class-alternate="btn-danger" class="btn-danger change-entry-livevote btn @defaultButtonSize" title="Enable Live-Voting">ENABLE LIVEVOTE</button>
@endif

<a href="{{route('backend.entries.comments.index', [$record->id])}}" class="ml-4 btn btn-sm @if ($record->comments()->where('read_by_organizer', false)->count() > 0) btn-danger @else btn-outline-secondary @endif">
    {{$record->comments()->count()}} Messages
</a>