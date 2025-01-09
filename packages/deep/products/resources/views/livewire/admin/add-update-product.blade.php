<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Add Product', 'routeName' => '', 'routeText' => '', 'link' => '', 'currentRoute' => 'addUpdateProduct'])

    <form wire:submit.prevent="submit" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-span-12 md:col-span-6">
                <label for="name" class="formLabel">Name *</label>
                <input type="text" wire:model="name" class="formInput" placeholder="Add Name" required/>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>        
            <div class="col-span-12 md:col-span-6">
                <label for="manufacturer" class="formLabel">Manufacturer *</label>
                <input type="text" wire:model="manufacturer" class="formInput" placeholder="Add manufacturer" required/>
                @error('manufacturer') <span class="error">{{ $message }}</span> @enderror
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

            <div class="col-span-12 md:col-span-6">
                <label for="functions" class="formLabel">Functions *</label>
                <input type="text" wire:model="functions" class="formInput" placeholder="Add functions" required/>
                @error('functions') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-6">
                <label for="tds" class="formLabel">TDS Code *</label>
                <input type="text" wire:model="tds" class="formInput" placeholder="TDS Code" required/>
                @error('TDS Code') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-6">
                <label for="url" class="formLabel">URL *</label>
                <input type="text" wire:model="url" class="formInput" placeholder="Add url" required/>
                @error('url') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-6">
                <label for="end" class="formLabel">End Applications *</label>
                <input type="text" wire:model="end" class="formInput" placeholder="Add end" required/>
                @error('end') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-6">
                <label for="status" class="formLabel">Status *</label>
                <select wire:model="status" class="formInput" required>
                    <option value="">Select Status</option>
                    <option value="1">Show</option>
                    <option value="0">Hide</option>
                </select>
                @error('status') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-6">
                <label for="image" class="formLabel">Image (300px X 250px) @if(!$media_id) * @endif </label>
                <input type="file" wire:model="image" @if(!$media_id) required @endif>
                @if($old_image) <img src="{{ $old_image }}" class="w-20 py-1" loading="lazy">@endif
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="editBtn w-full" wire:loading.remove>Submit</button>
            <span wire:loading class="editBtn w-full">Submit</span>
        </div>
    </form>
    <script>
        $(document).ready(function() { 
            $('#selectCat').select2({ placeholder: "Select Categories", allowClear: true }).on('change', function (e) {
                var data = $('#selectCat').select2("val"); @this.set('catSelected', data); });
            $('#selectTag').select2({ placeholder: "Select Tags", allowClear: true }).on('change', function (e) {
                var data = $('#selectTag').select2("val"); @this.set('tagSelected', data); });
        });
    </script>
</div>