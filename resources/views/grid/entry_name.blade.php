@if ($record->is_remote)<span class="badge badge-danger" v-if="is_remote">REMOTE</span> @endif<a href="" class="show-entry-description" data-id="{{$record->id}}">{{$record->title}}</a>
<br>
by {{$record->author}}

<ul class="list-unstyled">
    @foreach ($record->getMedia('file') as $file)
    <li><a title="Uploaded at {{$file->created_at}}" href="{{$file->getUrl()}}">Direct download: {{$file->file_name}}</a></li>
    @endforeach
</ul>