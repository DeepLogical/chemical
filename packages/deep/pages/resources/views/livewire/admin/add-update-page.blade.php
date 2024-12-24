<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => ' !$data_id ) Add Page : Update Page' , 'routeName' => '', 'routeText' => '', 'link' => '', 'currentRoute' => 'adminPages'])

    <form wire:submit.prevent="submit" method="POST">
        <div class="row">
            <div class="col-span-12 md:col-span-8">
                <div class="row">
                    <div class="col-span-12 md:col-span-4">
                        <label for="name" class="formLabel">Name *</label>
                        <input type="text" wire:model="name" class="formInput" placeholder="Add Name" required/>
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="url" class="formLabel">URL *</label>
                        <input type="text" wire:model="url" class="formInput" placeholder="Add URL" required>
                        @error('url') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="model" class="formLabel">Type *</label>
                        <select wire:model="model" class="formInput" required>
                            <option value="">Select Type</option>
                            @foreach( config('deep.page_options') as $i ) <option value="{{ $i }}" wire:key="page_options-{{ $loop->index }}">{{ $i }}</option> @endforeach
                        </select>
                        @error('model') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="type" class="formLabel">Sitemap *</label>
                        <select wire:model="sitemap" class="formInput" required>
                            <option value="">Select Sitemap Status</option>
                            <option value="1">Show</option>
                            <option value="0">Hide</option>
                        </select>
                        @error('sitemap') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="type" class="formLabel">Schema *</label>
                        <select wire:model="schema" class="formInput" required>
                            <option value="">Select Schema Status</option>
                            <option value="1">Show</option>
                            <option value="0">Hide</option>
                        </select>
                        @error('schema') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="type" class="formLabel">Status *</label>
                        <select wire:model="status" class="formInput" required>
                            <option value="">Select Status</option>
                            <option value="1">Show</option>
                            <option value="0">Hide</option>
                        </select>
                        @error('status') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <label for="url" class="formLabel">Image</label>
                        <input type="file" wire:model="image">
                        @if($old_image) <img src="{{ $old_image}}" class="w-20 py-1"> @endif
                        @error('image') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-12">
                        <label class="formLabel">Title - {{ strlen( $title ) }} *</label>
                        <input type="text" wire:model="title" class="formInput" placeholder="Add Title" required/>
                        @error('title') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-12">
                        <div>
                            <label for="description" class="formLabel">Description - {{ strlen( $description ) }} *</label>
                            <textarea  wire:model="description" class="formInput" placeholder="Add Description" style="min-height: 100px" required></textarea>
                            @error('description') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>                    
                    <div wire:ignore class="col-span-12">
                        <label class="formLabel">Text</label>
                        <textarea wire:model="text" class="formInput required" name="text" id="text"></textarea>
                    </div>
                    <script>const editormodule = CKEDITOR.replace('text'); editormodule.on('change', function(event){ @this.set("text", event.editor.getData()); });</script>
                    <div class="col-span-12 my-2">
                        <button type="button" class="btn" wire:click="addimage()">Add Preload Image</button>
                        <div class="row">
                            @for ($i = 0; $i < count($images); $i++)
                                <div class="col-span-6 row mt-3">
                                    <div class="col-span-10" wire:ignore>
                                        <label class="formLabel">Site</label>
                                        <input type="text"  wire:model="images.{{ $i}}" class="formInput" required/>
                                        @error('images.{{ $i}}') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-2">
                                        <label class="formLabel">Remove</label>
                                        <img src="/images/icons/delete.svg" class="w-6" wire:click="removeimage({{ $i}})">
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div class="mt-4">
                    <label class="formLabel">FAQ Title</label>
                    <input wire:model="faq_title" class="formInput" placeholder="FAQ Title">
                </div>
                <div class="mt-4">
                    <label for="faq_text" class="formLabel">FAQ Text</label>
                    <textarea  wire:model="faq_text" class="formInput" placeholder="Add FAQ Text" style="min-height: 40px"></textarea>
                    @error('faq_text') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label for="testis_cover" class="formLabel">Testimonial Cover</label>
                    <input type="file" wire:model="testis_cover">
                    @if($old_testis_cover) <img src="{{ $old_testis_cover}}" class="w-20 py-1"> @endif
                    @error('testis_cover') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label class="formLabel">Testimonial Title</label>
                    <input wire:model="testimonial_title" class="formInput" placeholder="Testimonial Title"/>
                </div>
                <div class="mt-4">
                    <label for="testimonial_text" class="formLabel">Testimonial Text</label>
                    <textarea  wire:model="testimonial_text" class="formInput" placeholder="Add Testimonial Text" style="min-height: 40px"></textarea>
                    @error('testimonial_text') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label class="formLabel">Blog Heading</label>
                    <input wire:model="blog_heading" class="formInput" placeholder="Blog Heading"/>
                </div>
                <div class="mt-4">
                    <label class="formLabel">Blog Text</label>
                    <textarea wire:model="blog_text" class="formInput" placeholder="Add Blog Text" style="min-height: 40px"></textarea>
                    @error('blog_text') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label class="formLabel">Contact Heading</label>
                    <input wire:model="contact_heading" class="formInput" placeholder="Contact Heading"/>
                </div>
                <div class="mt-4">
                    <label class="formLabel">Contact Text</label>
                    <textarea wire:model="contact_text" class="formInput" placeholder="Add Contact Text" style="min-height: 40px"></textarea>
                    @error('contact_text') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <button type="submit" class="editBtn mx-auto" wire:loading.remove>Submit</button>
            <span wire:loading class="editBtn">Please Wait</span>
        </div>
    </form>
</div>