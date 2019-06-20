@if ($record->is_remote)<span class="badge badge-danger">REMOTE</span> @endif<a href="" class="show-entry-description" data-id="{{$record->id}}">{{$record->title}}</a>
<br>
by {{$record->author}}

<ul class="list-unstyled">
    @foreach ($record->ordered_files as $file)
        @if ($loop->first)
            <li><a style="color: green;" title="Uploaded at {{$file->created_at}}" href="{{$file->getUrl()}}">Direct download: {{$file->file_name}} (newest) @if ($record->final_file_media_id == $file->id) (final file) @endif</a></li>
        @else
            <li><a title="Uploaded at {{$file->created_at}}" href="{{$file->getUrl()}}">Direct download: {{$file->file_name}} @if ($record->final_file_media_id == $file->id) (final file) @endif</a></li>
        @endif
    @endforeach
</ul>