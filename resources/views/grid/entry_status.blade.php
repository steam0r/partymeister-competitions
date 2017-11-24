<div class="btn-group" role="group">
    <button type="button" data-value="0" class="btn @defaultButtonSize @if ($record->status == 0)btn-danger @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.0')}}">U</button>
    <button type="button" data-value="1" class="btn @defaultButtonSize @if ($record->status == 1)btn-success @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.1')}}">C</button>
    <button type="button" data-value="3" class="btn @defaultButtonSize @if ($record->status == 3)btn-black @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.3')}}">D</button>
    <button type="button" data-value="4" class="btn @defaultButtonSize @if ($record->status == 4)btn-black @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.4')}}">P</button>
    <button type="button" data-value="2" class="btn @defaultButtonSize @if ($record->status == 2)btn-warning @else btn-outline-secondary @endif" title="{{trans('partymeister-competitions::backend/entries.stati.2')}}">F</button>
</div>