@if ($record->is_remote)<span class="badge badge-danger" v-if="is_remote">REMOTE</span> @endif<a href="" class="show-entry-description" data-id="{{$record->id}}">{{$record->title}}</a>
<br>
by {{$record->author}}