<div>	
	<div class="@if(!$isOpen) hidden @endif bg-dark fixed h-full left-0 top-0 w-full z-50">
		<div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
			<div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
				<h2 class="font-bold w-full">Add / Update Achievement Here</h2>
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

						<div class="col-span-12">
							<label for="status" class="formLabel">Status *</label>
							<select wire:model="status" class="formInput" required>
								<option value="">Select Status</option>
								<option value="1">Active</option>
								<option value="0">In Active</option>
							</select>
							@error('status') <span class="error">{{ $message }}</span> @enderror
						</div>
						@foreach( $achievement as $key => $i )
							<div class="col-span-12">
								<label class="formLabel">Name *</label>
								<input type="text" wire:model="achievement.{{$key}}.name" class="formInput" placeholder="Name" required>
								@error('achievement.$key.name') <span class="error">{{ $message }}</span> @enderror
							</div>
							<div class="col-span-12 md:col-span-6">
								<label class="formLabel">Image</label>
								<input type="file" wire:model="achievement.{{$key}}.image">
								@error('achievement.$key.image') <span class="error">{{ $message }}</span> @enderror
								@if( $achievement[$key]['old_image'] ) <img src="{{ $achievement[$key]['old_image'] }}" class="w-32 p-1">@endif
							</div>
							<div class="col-span-12 md:col-span-6">
								<label class="formLabel">Value *</label>
								<input type="number" wire:model="achievement.{{$key}}.value" class="formInput" placeholder="Value" required>
								@error('achievement.$key.value') <span class="error">{{ $message }}</span> @enderror
							</div>
						@endforeach
					</div>
					<div class="text-center mt-5">
						<button type="submit" class="btn w-full" wire:loading.remove>Submit</button>
						<span wire:loading class="btn w-full">Please wait</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>