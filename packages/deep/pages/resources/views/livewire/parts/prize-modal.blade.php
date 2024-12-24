<div>
	<button wire:click="openModal()" class="btn my-3">Add Prizes</button>
	
	@if( $data && count( $data) )
		<div class="row py-5">
			@foreach( $data as $i )
				<div class="col-span-12 md:col-span-3 relative" wire:key="media_gallery-{{ $loop->index }}">
					<img src="{{ optional($i->media)->path }}" alt="">
					<p class="font-bold">{{ $i->rank }}</p>
					{!! $i->prize !!}
					<img src="/images/icons/static/edit.svg" class="w-6 hover:cursor-pointer absolute bottom-0 right-0 m-1" wire:click="edit('{{ encode( $i->id ) }}')">
				</div>				
			@endforeach
		</div>
	@endif

	@if($isOpen)
		<div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
			<div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
				<div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
					<h2 class="font-bold w-full">Add / Update Prize</h2>
					<img wire:click="closeModal()" src="/images/icons/static/cross.svg" class="h-6 w-6 ml-auto hover:cursor-pointer">
				</div>
				<div class="h-70 md:h-full p-2">
					<form wire:submit.prevent="submit" method="POST" autocomplete="off">
						<div class="row">
							<div class="col-span-12">
								<label class="formLabel">Image</label>
								<input type="file" wire:model="image" class="formInput">
								@if( $old_image ) <img src="{{ $old_image }}" class="w-20"> @endif
								@error('image') <span class="error">{{ $message }}</span> @enderror
							</div>
							<div class="col-span-12">
								<label class="formLabel">Rank *</label>
								<input type="text" wire:model="rank" class="formInput" placeholder="Add Rank" required>
								@error('rank') <span class="error">{{ $message }}</span> @enderror
							</div>
							<div class="col-span-12 md:col-span-6">
								<label class="formLabel">Display Order</label>
								<input type="number" wire:model="display_order" class="formInput" placeholder="Add Display Order">
								@error('display_order') <span class="error">{{ $message }}</span> @enderror
							</div>
							<div class="col-span-12 md:col-span-6">
								<label class="formLabel">Status *</label>
								<select wire:model="status" class="formInput" required>
									<option value="">Select Status</option>
									<option value="1">Show</option>
									<option value="0">Hide</option>
								</select>
								@error('status') <span class="error">{{ $message }}</span> @enderror
							</div>
							<div class="col-span-12" wire:ignore>
								<label for="prize" class="formLabel">Prize</label>
								<textarea id="prize" wire:model="prize"></textarea>
							</div>
							<script>const editor = CKEDITOR.replace('prize'); editor.on('change', function(event){ @this.set("prize", event.editor.getData()); });</script>
						</div>
						<div class="text-center mt-5">
							<button class="editBtn w-full" wire:loading.remove>Submit</button>
							<span wire:loading class="editBtn w-full">Submit</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endif
</div>