<div>
	@if( !$hide_btn ) <button wire:click="openModal()" class="btn my-3">Add Video</button> @endif
	
	@if( $data && count( $data) )
		<div class="row py-5">
			@foreach( $data as $i )
				<div class="col-span-12 md:col-span-4 flex flex-wrap items-center justify-between" wire:key="video_gallery-{{ $loop->index }}">
					<iframe src="https://www.youtube.com/embed/2I8tzbimBHw?si={{ $i->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="w-full video_iframe"></iframe>

					
					@if( Auth::user()->hasRole([ 'owner', 'superadmin', 'admin', 'seo' ]) && !$hide_btn )
						<img src="/images/icons/static/edit.svg" class="w-6 hover:cursor-pointer" wire:click="edit('{{ encode( $i->id ) }}')">
					@endif
				</div>				
			@endforeach
		</div>
	@endif

	@if($isOpen)
		<div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
			<div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
				<div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
					<h2 class="font-bold w-full">Add / Update Video</h2>
					<img wire:click="closeModal()" src="/images/icons/static/cross.svg" class="h-6 w-6 ml-auto hover:cursor-pointer">
				</div>
				<div class="h-70 md:h-full p-2">
					<form wire:submit.prevent="submit" method="POST" autocomplete="off">
						<div class="row">
							<div class="col-span-12">
								<label class="formLabel">Video URL *</label>
								<input type="text" wire:model="url" class="formInput" placeholder="Add Video URL" required>
								@error('url') <span class="error">{{ $message }}</span> @enderror
							</div>
							@if( $this->model != "Match" )
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
							@endif
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