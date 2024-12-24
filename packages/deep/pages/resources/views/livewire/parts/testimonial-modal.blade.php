<div>	
	<div class="@if(!$isOpen) hidden @endif bg-dark fixed h-full left-0 top-0 w-full z-50">
		<div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
			<div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
				<h2 class="font-bold w-full">Add / Update Testimonial Here</h2>
				<img wire:click="closeModal()" src="/images/icons/static/cross.svg" class="h-6 w-6 ml-auto hover:cursor-pointer">
			</div>
			<div class="h-70 md:h-full p-2">
				<form wire:submit.prevent="submit" method="POST" autocomplete="off">					
					<div class="row">
						@if( $initModal )
							<div class="col-span-12 md:col-span-6">
								<label class="formLabel">Model *</label>							
								<select class="formInput"wire:model.live="model" required>
									<option value="">Select Model Type</option>
									<option value="Page">Page</option>
								</select>
								@error('model') <span class="error">{{ $message }}</span> @enderror
							</div>
							<div class="col-span-12 md:col-span-6">
								<label class="formLabel">Model *</label>							
								<select class="formInput" wire:model="model_id" required>
									<option value="">Select Model</option>
									@foreach($model_options as  $i)<option value="{{ $i->id}}" wire:key="modal_options-{{ $loop->index }}">{{ $i->name }}</option>@endforeach
								</select>
								@error('model_id') <span class="error">{{ $message }}</span> @enderror
							</div>
						@endif

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
							<label for="name" class="formLabel">Name</label>
							<input type="text" wire:model="name" class="formInput" placeholder="Add Name"/>
							@error('name') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12">
							<label for="role" class="formLabel">Role</label>
							<input type="text" wire:model="role" class="formInput" placeholder="Add Role">
							@error('role') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12 md:col-span-4">
							<label for="image" class="formLabel">Image</label>
							<input type="file" wire:model="image">
							@if($old_image) <img src="{{ $old_image }}" class="w-20 py-1"> @endif
							@error('image') <span class="error">{{ $message }}</span> @enderror
						</div>
						<div class="col-span-12">
							<label for="testis" class="formLabel">Testimonial *</label>
							<div wire:ignore>
								<textarea id="ckeditorx" class="ckeditorx" wire:model="testis"></textarea>							
							</div>
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

	@push("scripts")
		<script>
			const editor = CKEDITOR.replace('ckeditorx'); 
			$(document).ready(function () {
				window.Livewire.on('initializeCKEditor', function () {
					editor.destroy();
					const editor2 = CKEDITOR.replace('ckeditorx');
					console.log(11111111)
					editor2.on('change', function(event) { 
						@this.set("testis", event.editor.getData());
					});
				});
			});
		</script>
	@endpush
</div>