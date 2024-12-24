<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Add Blog', 'routeName' => '', 'routeText' => '', 'link' => '', 'currentRoute' => 'addUpdateBlog'])

    <form wire:submit.prevent="submit" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-span-12 md:col-span-4">
                <label for="name" class="formLabel">Title *</label>
                <input type="text" wire:model="name" class="formInput" placeholder="Add Title" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-4">
                <label for="url" class="formLabel">URL *</label>
                <input type="text" wire:model="url" class="formInput" placeholder="Add URL" required>
                @error('url') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-4">
                <label for="url" class="formLabel">Image @if( !$media_id ) * @endif</label>
                <input type="file" wire:model="image" @if( !$media_id ) required @endif>
                @if($old_image) <img src="{{ $old_image }}" class="w-20 py-1"> @endif
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div wire:ignore class="col-span-12 md:col-span-6">
                <label for="catSelected" class="formLabel">Category</label>
                <select class="w-full form-control" wire:model="catSelected" id="selectCat" multiple>
                    @foreach($catOptions as $i)<option wire:key="catOptions-{{ $loop->index }}" value="{{ $i->id}}">{{ $i->name }}</option>@endforeach
                </select>
            </div>
            <div wire:ignore class="col-span-12 md:col-span-6">
                <label for="tagSelected" class="formLabel">Tags</label>
                <select id='selectTag' wire:model="tagSelected" multiple class="w-full">
                    @foreach($tagOptions as $i)<option wire:key="tagOptions-{{ $loop->index }}" value="{{ $i->id}}">{{ $i->name }}</option>@endforeach
                </select>
            </div>
            <div wire:ignore class="col-span-12 md:col-span-4">
                <label for="tagSelected" class="formLabel">Author</label>
                <select class="formInput" wire:model="author_id">
                    <option value="">Select Author</option>
                    @foreach($authorOptions as  $i)<option value="{{ $i->id}}" wire:key="authorOptions-{{ $loop->index }}">{{ $i->name }}</option>@endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-8">
                <label for="title" class="formLabel">Meta Title * - {{ strlen( $title ) }}</label>
                <input type="text" wire:model="title" class="formInput" placeholder="Add Title" required>
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12">
                <label for="description" class="formLabel">Meta Description * - {{ strlen( $description ) }}</label>
                <textarea wire:model="description" class="formInput" placeholder="Add Description" required></textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>                        
            <div class="col-span-12">
                <div wire:ignore >
                    <label for="content" class="formLabel">Blog Content *</label>
                    <textarea wire:model="content" class="formInput required" name="content" id="content"></textarea>
                </div>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12">
                <div wire:ignore>
                    <label for="excerpt" class="formLabel">Blog Excerpt</label>
                    <textarea wire:model="excerpt" class="formInput required" name="excerpt" id="excerpt"></textarea>
                </div>
                @error('excerpt') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="editBtn mx-auto" wire:loading.remove>Submit</button>
                <span wire:loading class="editBtn">Please Wait</span>
            </div>
        </div>
    </form>
    <script>
        const editor = CKEDITOR.replace('content'); editor.on('change', function(event){ @this.set('content', event.editor.getData()); });
        const editor2 = CKEDITOR.replace('excerpt'); editor2.on('change', function(event){ @this.set('excerpt', event.editor.getData()); });
        $(document).ready(function() { 
            $('#selectCat').select2({ placeholder: "Select Categories", allowClear: true }).on('change', function (e) {
                var data = $('#selectCat').select2("val"); @this.set('catSelected', data); });
            $('#selectTag').select2({ placeholder: "Select Tags", allowClear: true }).on('change', function (e) {
                var data = $('#selectTag').select2("val"); @this.set('tagSelected', data); });
        });
    </script>
</div>