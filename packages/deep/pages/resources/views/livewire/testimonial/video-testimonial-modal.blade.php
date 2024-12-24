<div>
	<div class="@if( !$isOpen ) hidden @endif bg-dark fixed h-full left-0 top-0 w-full z-50">
		<div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
			<div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
				<h2 class="font-bold w-full">Add / Update Video Testimonial Here</h2>
				<img wire:click="closeModal()" src="/images/icons/static/cross.svg" class="h-6 w-6 ml-auto hover:cursor-pointer">
			</div>
			<div class="h-70 md:h-full p-2">
				<form wire:submit.prevent="submit" method="POST" autocomplete="off">					
					<div class="row">
						<div class="col-span-12 md:col-span-6">
							<label class="formLabel">Model *</label>							
							<select class="formInput"wire:model.live="model" required>
								<option value="">Select Model Type</option>
								@foreach( config('deep.page_options') as $i ) <option value="{{ $i }}">{{ $i }}</option> @endforeach
							</select>
							@error('model') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12 md:col-span-6">
							<label class="formLabel">Model *</label>							
							<select class="formInput" wire:model="model_id" required>
								<option value="">Select Model</option>
								@foreach($model_options as $i)<option value="{{ (int)$i->id }}" wire:key="modal_options-{{ $loop->index }}" @if( $model_id == $i->id ) selected @endif>{{ $i->name }}</option>@endforeach
							</select>
							@error('model_id') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12 md:col-span-6">
							<label class="formLabel">Status *</label>
							<select class="formInput" wire:model="status" required>
								<option value="">Select Status</option>
								<option value="1">Active</option>
								<option value="0">Not Active</option>
							</select>
							@error("status") <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12 md:col-span-6">
							<label class="formLabel">Display Order</label>
							<input type="number" wire:model="display_order" class="formInput" placeholder="Add Display Order">
							@error('display_order') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12">
							<label for="name" class="formLabel">Name *</label>
							<input type="text" wire:model="name" class="formInput" placeholder="Add Name" required/>
							@error('name') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12">
							<label for="role" class="formLabel">Role *</label>
							<input type="text" wire:model="role" class="formInput" placeholder="Add Role" required>
							@error('role') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12 md:col-span-4">
							<label for="image" class="formLabel">Image @if( !$media_id ) * @endif</label>
							<input type="file" wire:model="image" @if( !$media_id ) required @endif>
							@if($old_image) <img src="{{ $old_image }}" class="w-20 py-1"> @endif
							@error('image') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12">
							<label for="url" class="formLabel">URL *</label>
							<input type="text" wire:model="url" class="formInput" placeholder="Add URL" required>
							@error('url') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12">
							<label for="testis" class="formLabel">Testimonial *</label>
							<div wire:ignore>
								<textarea id="ckeditorx" class="ckeditorx" wire:model="testis" required></textarea>
							</div>
							@error('testis') <span class="error">{{ $message }}</span> @enderror
						</div>
					</div>
					<div class="text-center mt-5">
						<button type="submit" class="btn w-full">Submit</button>
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
				console.log("INIT")
				const editor2 = CKEDITOR.replace('ckeditorx');
				editor2.on('change', function(event) { 
					@this.set("testis", event.editor.getData());
				});
			});
		});
	</script>
</div>