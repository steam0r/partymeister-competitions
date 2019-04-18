<h4 class="clearfix">
    <a href="{{route('frontend.pages.index', ['slug' => $component->entry_edit_page->full_slug])}}" class="float-right button success small">Upload entry</a>
    Your entries
</h4>
@if ($entries->count() == 0)
    <div class="callout warning">
        You haven't uploaded any entries yet!
    </div>
@endif
<div class="grid-x grid-margin-x" data-equalizer data-equalize-by-row="true">
    @foreach ($entries as $entry)
        <div class="cell medium-6 small-12">
            <div class="card" data-equalizer-watch>
                @if($entry->getFirstMedia('screenshot'))
                    <div class="image-wrapper">
                        <a data-caption="{{$entry->title}} by {{$entry->author}}" data-fancybox="gallery"
                           href="{{$entry->getFirstMedia('screenshot')->getUrl('preview')}}">
                            <img src="{{$entry->getFirstMedia('screenshot')->getUrl('preview')}}" class="img-fluid"
                                 style="">
                        </a>
                    </div>
                @endif
                <div class="card-section column">
                    <div style="flex-grow: 1;">
                        <h5>{{$entry->title}} by {{$entry->author}}</h5>
                        <h6>{{$entry->competition->name}}</h6>
                        @if ($entry->options->count() > 0 || $entry->custom_option != '')
                            <h6 class="mt-2">Options</h6>
                            <ul class="list-unsorted">
                                @foreach ($entry->options as $option)
                                    <li>{{$option->name}}</li>
                                @endforeach
                                @if($entry->custom_option != '')
                                    <li>{{$entry->custom_option}}</li>
                                @endif
                            </ul>
                        @endif
                        <p class="card-text">{{$entry->description}}</p>
                    </div>
                    <div class="align-self-bottom">
                        <div class="small expanded button-group">
                            @if ($entry->competition->upload_enabled || $entry->upload_enabled)
                                <a href="{{route('frontend.pages.index', ['slug' => $component->entry_edit_page->full_slug]) }}?entry_id={{$entry->id}}"
                                   class="button primary">Edit</a>
                            @endif
                            @if ($entry->competition->competition_type->has_screenshot)
                                <a href="{{route('frontend.pages.index', ['slug' => $component->entry_screenshots_page->full_slug])}}?entry_id={{$entry->id}}"
                                   class="button primary">Update screenshot</a>
                            @endif
                            <a href="{{route('frontend.pages.index', ['slug' => $component->entry_detail_page->full_slug])}}?entry_id={{$entry->id}}"
                               class="button primary">Show</a>
                        </div>
                        <a href="{{route('frontend.pages.index', ['slug' => $component->entry_comments_page->full_slug])}}?entry_id={{$entry->id}}"
                           class="button small expanded @if ($entry->new_comments > 0)warning @else secondary @endif">Messages @if ($entry->new_comments > 0)
                                ({{$entry->new_comments}} NEW) @endif</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
