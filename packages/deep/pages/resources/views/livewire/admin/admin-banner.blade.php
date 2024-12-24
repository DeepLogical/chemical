<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Admin Banner Slider', 'routeName' => '', 'routeText' => 'Add Banner Slider', 'link' => 'true'])
    
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Page</th>
                <th>Heading</th>
                <th>URL</th>
                <th>Media</th>
                <th>Status</th>
                <th>Display Order</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td><a href="{{ optional($i->page)->url }}" target="_blank">{{ optional($i->page)->name }}</a></td>
                    <td style="max-width: 100px">{{ $i->heading }}</td>
                    <td>{{ $i->url }}</td>
                    <td>
                        <img src="{{ optional($i->media)->path }}" class="w-32 mb-3" loading="lazy">
                        <img src="{{ optional($i->mobile_media)->path }}" class="w-32" loading="lazy">
                    </td>
                    <td>
                        <div class="gsap">
                            <label class="switch">
                                <input type="checkbox" wire:click="changeStatus('{{ encode($i->id) }}', '{{ encode($i->status) }}')" @if($i->status) checked @endif/>
                                <svg viewBox="0 0 38 24" filter="url(#goo)"><circle class="default" cx="12" cy="12" r="8"/><circle class="dot" cx="26" cy="12" r="8"/></svg>
                            </label>
                        </div>
                    </td>
                    <td>{{ $i->display_order }}</td>
                    <td><button class="editBtn" wire:click="edit( '{{ encode( $i->id ) }}' )">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif
    
    <div class="@if(!$isOpen) hidden @endif bg-dark fixed h-full left-0 top-0 w-full z-50">
        <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-3/4 overflow-y-auto right-0 w-full z-20">
            <div class="flex bg-gray-100 border-b items-center justify-center p-2">
                <h2 class="font-bold w-full">Add / Update Banner Slider</h2>
                <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
            </div>
            <div class="h-70 md:h-full p-2">
                <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="col-span-12 md:col-span-6">
                            <label class="formLabel">Model Type *</label>							
                            <select class="formInput" wire:model.live="model" required>
                                <option value="">Select Model Type</option>
                                <option value="Page">Page</option>
                            </select>
                            @error('model') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        @if($isOpen)
                            <div class="col-span-12 md:col-span-6">
                                <label class="formLabel">Model *</label>							
                                <select class="formInput" wire:model="model_id" required>
                                    <option value="">Select Model</option>
                                    @foreach($model_options as $i)<option value="{{ (int)$i->id }}" wire:key="modal_options-{{ $loop->index }}">{{ $i->name }}</option>@endforeach
                                </select>
                                @error('model_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        <div class="col-span-12 md:col-span-6">
                            <label for="status" class="formLabel">Status *</label>
                            <select wire:model="status" class="formInput" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                            @error('status') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="formLabel">Display Order</label>
                            <input type="text" wire:model="display_order" class="formInput" placeholder="Add Display Order"/>
                            @error('display_order') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="formLabel">Image (1920px X 640px) @if(!$media_id) * @endif</label>
                            <input type="file" wire:model="image" @if(!$media_id) required @endif>
                            @if($old_image) <img src="{{ $old_image }}" class="w-20 py-1"> @endif
                            @error('image') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="formLabel">Mobile Image (600px X 900px) @if(!$mobile_media_id) * @endif</label>
                            <input type="file" wire:model="mobile_image" @if(!$mobile_media_id) required @endif>
                            @if($old_mobile_image) <img src="{{ $old_mobile_image }}" class="w-20 py-1"> @endif
                            @error('mobile_image') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label class="formLabel">URL</label>
                            <input type="text" wire:model="url" class="formInput" placeholder="Add Slug"/>
                            @error('url') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12">
                            <label class="formLabel">Heading *</label>
                            <textarea wire:model="heading" class="formInput" placeholder="Add Heading" required></textarea>
                            @error('heading') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-12">
                            <label for="text" class="formLabel">Text *</label>
                            <div wire:ignore>
                                <textarea id="ckeditorx" class="ckeditorx" wire:model="text"></textarea>
                            </div>
                            @error('text') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="btn w-full" wire:loading.remove>Submit</button>
                        <span wire:loading class="btn w-full">Submit</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
		const editor = CKEDITOR.replace('ckeditorx');
		$(document).ready(function () {
			window.Livewire.on('initializeCKEditor', function () {
				editor.destroy();
				const editor2 = CKEDITOR.replace('ckeditorx');
				editor2.on('change', function(event) { 
                    console.log( event.editor.getData() )
					@this.set("text", event.editor.getData());
				});
			});
		});
	</script>
</div>