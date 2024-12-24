@if( $isOpen )
	<div class="normalModal fixed top-0 h-full w-full" style="background: #000000bf; padding-top: 2em; z-index: 10002" tabindex="-1" role="dialog" id="myModal">
		<style>
			.normalModal .animated{
				/* max-width: 90%; */
				left: 0;
				right: 0;
				margin: 0 auto;
				padding: 2em;
				background: transparent;
			}
			.subscribeModalForm .formInput{
				background: transparent;
				border: none;
				border-bottom: 2px solid #fff;
				border-radius: 0;
				color: #fff;
				width: 100%;
			}
			.subscribeModalForm .formInput::placeholder {
				color: #fff;
			}
		</style>
		<div class="animated fade bg-white top-0 duration-300 fixed h-70pc md:h-full overflow-y-auto right-0 w-full">
			<button wire:click="closeModal()" class="absolute top-0 font-semibold text-xl text-white" style="right:40px; z-index: 10002">X</button>
			<form wire:submit.prevent="submit" method="POST" class="subscribeModalForm w-full py-3 flex items-center">
				<div class="w-full">
					<input type="text" class="formInput" placeholder="Search ..." wire:model="search" required>
					@error('search') <span class="error text-white">{{ $message }}</span> @enderror
				</div>
				<button type="submit" class="submit-button">
					<img src="/images/icons/search-white.svg" alt="" class="w-6 hover:cursor-pointer">
				</button>
			</form>
			<div class="row">
				@if( $blogs && count($blogs) )
					<div class="col-span-12 md:col-span-3">
						<h2 class="bg-action text-center text-white p-2 rounded-md text-xl mb-3">Blogs</h2>
						<ul>
							@foreach( $blogs as $i ) 
								<li wire:key="blogs-{{ $loop->index }}">
									<a href="{{ route('single', ['url' => $i->url] ) }}" class="text-white pb-2">{{ $i->name }}</a>
								</li>
							@endforeach
						</ul>
					</div>
				@endif

				@if( $products && count($products) )
					<div class="col-span-12 md:col-span-3">
						<h2 class="bg-action text-center text-white p-2 rounded-md text-xl mb-3">Products</h2>
						<ul>
							@foreach( $products as $i ) 
								<li wire:key="products-{{ $loop->index }}">
									<a href="{{ route('singleProduct', ['url' => $i->url] ) }}" class="text-white pb-2">{{ $i->name }}</a>
								</li>
							@endforeach
						</ul>
					</div>
				@endif

				@if( $productMeta && count($productMeta) )
					<div class="col-span-12 md:col-span-3">
						<h2 class="bg-action text-center text-white p-2 rounded-md text-xl mb-3">Product Tags</h2>
						<ul>
							@foreach( $productMeta as $i ) 
								<li wire:key="productMeta-{{ $loop->index }}">
									<a href="{{ route('productType', [ 'type' => $i->type, 'url' => $i->url] ) }}" class="text-white pb-2">{{ $i->name }}</a>
								</li>
							@endforeach
						</ul>
					</div>
				@endif

				@if( $brand && count($brand) )
					<div class="col-span-12 md:col-span-3">
						<h2 class="bg-action text-center text-white p-2 rounded-md text-xl mb-3">Brands</h2>
						<ul>
							@foreach( $brand as $i ) 
								<li wire:key="brand-{{ $loop->index }}">
									<a href="{{ route('productBrand', ['url' => $i->url] ) }}" class="text-white pb-2">{{ $i->name }}</a>
								</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
		</div>
	</div>
@else
	<div></div>
@endif