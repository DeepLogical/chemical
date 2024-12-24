<div id="contactModal" class="fixed hidden h-full left-0 top-0 w-full z-50" style="background: #000000bf; padding-top: 2em" tabindex="-1" role="dialog" id="myModal">
	<div class="animated fade bg-white bottom-0 duration-300 fixed h-70pc md:h-full md:h-full md:w-1/3 overflow-y-auto right-0 shadow-lg w-full z-20">
		<div class="flex ites-center justify-between mb-2 p-2 bg-gray-200">
			<h2 class="text-xl font-semibold">Connect with Us</h2>
			<button class="closeContactModal font-semibold text-xl">X</button>
		</div>
		<div class="p-2 ">
			@livewire('contactForm')
		</div>
	</div>
</div>