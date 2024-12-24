<div>
    @livewire('adminSearch', ['page' => 'Admin Blog Meta', 'routeName' => '', 'routeText' => 'Add Blog Meta', 'link' => 'true'])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Name || URL</th>
                <th>Image</th>
                <th>Meta</th>
                <th>Blogs</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>{{ ucfirst( $i->type ) }}</td>
                    <td><a href="/{{ $i->type }}/{{ $i->url }}" target="_blank">{{ $i->name }}<br/>{{ $i->url }}</a></td>
                    <td>
                        @if( optional($i->media)->path )
                            <img src="/storage/blogmeta/{{ optional($i->media)->path }}" alt="" class="w-32">
                        @endif
                    </td>
                    <td>
                        @if($i->meta)
                            <span class="{{ strlen( optional($i->meta)->title ) < 50 || strlen( optional($i->meta)->title ) > 60 ? 'text-action px-1 py-1' : '' }}">Title: {{ optional($i->meta)->title }} - {{ strlen( optional($i->meta)->title ) }}</span><br/>
                            <span class="{{ strlen( optional($i->meta)->description ) < 140 || strlen( optional($i->meta)->description ) > 160 ? 'text-action px-1 py-1' : '' }}">Description: {{ optional($i->meta)->description}} -  {{ strlen( optional($i->meta)->description ) }}</span>
                        @endif
                    </td>
                    <td>@if($i->blogs) {{ count( $i->blogs ) }} @endif</td>
                    <td><button class="editBtn" wire:click="edit( '{{ encode( $i->id ) }}' )">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif

    @if($isOpen)
        <div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
            <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                    <h2 class="font-bold w-full">Add Update Blogmeta Here</h2>
                    <img src="{{ asset('/images/icons/static/cross.svg') }}" class="ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
                </div>
                <div class="h-70 md:h-full p-2">
                    <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="col-span-12">
                                <label for="type" class="formLabel">Type *</label>
                                <select wire:model="type" class="formInput" required>
                                    <option value="">Select Type</option>
                                    <option value="category">Category</option>
                                    <option value="tag">Tag</option>
                                </select>
                                @error('type') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="name" class="formLabel">Name *</label>
                                <input type="text" wire:model="name" class="formInput" placeholder="Add Name" required/>
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="url" class="formLabel">URL *</label>
                                <input type="text" wire:model="url" class="formInput" placeholder="Add URL" required>
                                @error('url') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <label class="formLabel">Image</label>
                                <input type="file" wire:model="image">
                                @error('image') <span class="error">{{ $message }}</span> @enderror
                                @if($old_image) <img src="{{ $old_image }}" class="w-20 py-1"> @endif
                            </div>
                            <div class="col-span-12">
                                <label for="title" class="formLabel {{ strlen( $title ) < 50 || strlen( $title ) > 60 ? 'text-action p-2' : '' }}">Title - {{ strlen( $title ) }} *</label>
                                <input type="text" wire:model="title" class="formInput" placeholder="Add Title" required>
                                @error('title') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="description" class="formLabel {{ strlen( $description ) < 140 || strlen( $description ) > 160 ? 'text-action p-2' : '' }}">Description - {{ strlen( $description ) }} *</label>
                                <textarea  wire:model="description" class="formInput" placeholder="Add Description" style="min-height:150px" required></textarea>
                                @error('description') <span class="error">{{ $message }}</span> @enderror
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
    @endif
</div>