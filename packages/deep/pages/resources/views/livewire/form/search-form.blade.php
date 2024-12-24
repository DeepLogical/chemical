<div class="relative" x-data="{ display : false }" @click.away="display = false">
	<form wire:submit.prevent="submit" method="POST" class="subscribeModalForm py-1 flex items-center rounded-full border-2 px-3 md:px-5" style="max-width: 400px;">
		<div class="w-full">
			<input @click="display = true" type="text" class="formInput py-3" placeholder="Search ..." wire:model="search" required style="border: none; background:transparent">
			@error('search') <span class="error">{{ $message }}</span> @enderror
		</div>
		<button type="submit" class="submit-button">
			<img src="/images/icons/static/search.svg" alt="" class="w-6 hover:cursor-pointer">
		</button>	
	</form>

	@if( $search_options && count( $search_options ) )
		<div x-show="display === true" class="absolute bg-white flex flex-wrap items-center overflow-y-auto" style="border: 2px solid #eee; max-height: 200px;">
			@foreach( $search_options as $i )
				<a href="{{ route('singleProduct', ['url' => $i->url] ) }}" class="flex items-center hover:cursor-pointer py-1 px-5" wire:key="search_option-{{ $loop->index }}" style="border-bottom: 2px solid #eee;">
					<img src="{{ optional(optional($i->media)->first())->path }}" class="imgExpand mr-3" style="max-height: 50px; width: auto"/>
					<span>{{ $i->name }}</span>
				</a>
			@endforeach
		</div>
	@endif
</div>