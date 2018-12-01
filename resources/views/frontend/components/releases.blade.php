<h4>
    Releases
</h4>
@if (is_null($competition))
    <div class="callout warning">
        There are no releases yet!
    </div>
@endif
@if (!is_null($competition))
    <h4>{{$competition->name}}</h4>
    <div class="grid-x grid-margin-x">
        @foreach ($competition->entries()->where('status', 1)->orderBy('sort_position', 'ASC')->get() as $entry)
            <div class="cell medium-6 small-12">
                <div class="card">
                    @if($entry->getFirstMedia('screenshot'))
                        <div class="image-wrapper">
                            <a data-caption="{{$entry->title}} by {{$entry->author}}" data-fancybox="gallery"
                               href="{{$entry->getFirstMedia('screenshot')->getUrl('preview')}}">
                                <img src="{{$entry->getFirstMedia('screenshot')->getUrl('preview')}}"
                                     class="img-fluid">
                            </a>
                        </div>
                    @endif
                    @if($entry->getFirstMedia('audio'))
                        <audio controls src="{{$entry->getFirstMedia('audio')->getUrl()}}" style="width: 100%"></audio>
                    @endif
                        <div class="card-section">
                        <h5>{{$entry->title}} by {{$entry->author}}</h5>
                        <h6>{{$entry->competition->name}}</h6>
                        @if ($entry->download != null)
                            <div class="clearfix"></div>
                            <a href="{{$entry->download->getUrl()}}" style="text-decoration: none !important">
                                <button type="button" class="btn btn-sm btn-block btn-success mt-3">
                                    Download
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
