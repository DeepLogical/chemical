<div class="web col-span-12 md:col-span-4 web" style="padding: 15px; height: fit-content">
    <div class="mb-5 py-5 px-3">
        <input type="text" class="formInput" wire:model.live="search" placeholder="Search">
    </div>

    @if( $category && count($category) )
        <div>
            <h2 class="sidebarHeading relative pb-3 font-bold mt-4">Category</h2>
            <div>
                @foreach($category as $key => $i)
                    <div wire:key="cat-{{ $key }}" class="flex items-center mb-3 options">
                        <input type="checkbox" name="catSelected" value="{{ $i->id }}" wire:model.live="catSelected" class="checkbox mr-3" id="cat-{{ $key }}" {{ in_array($i->id, $catSelected) ? 'checked' : '' }} >
                        <label class="checklabel hover:cursor-pointer" for="cat-{{ $key }}">{{ $i->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if( $tag && count($tag) )
        <div>
            <h2 class="sidebarHeading relative pb-3 font-bold mt-4">Tag</h2>
            <div>
                @foreach($tag as $key => $i)
                    <div wire:key="tag-{{ $key }}" class="flex items-center mb-3 options">
                        <input type="checkbox" name="tagSelected" value="{{ $i->id }}" wire:model.live="tagSelected" class="checkbox mr-3" id="tag-{{ $key }}" {{ in_array($i->id, $tagSelected) ? 'checked' : '' }} >
                        <label class="checklabel hover:cursor-pointer" for="tag-{{ $key }}">{{ $i->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>