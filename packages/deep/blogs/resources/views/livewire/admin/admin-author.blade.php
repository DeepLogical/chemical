
<div>
    @livewire('adminSearch', [ 'page' => 'Admin Author', 'routeName' => '', 'routeText' => 'Add Author', 'link' => 'true', 'links' => $links ])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>#</th>
                <th>Author // Image</th>
                <th>Bio</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>
                        <img src="{{ optional($i->media)->path }}" class="w-24 py-1" loading="lazy">
                        {{ $i->name }}
                    </td>
                    <td>{{ $i->bio}}</td>
                    <td>
                        <div class="gsap">
                            <label class="switch">
                                <input type="checkbox" wire:click="changeStatus('{{ encode($i->id) }}', '{{ encode($i->status) }}')" @if($i->status) checked @endif/>
                                <svg viewBox="0 0 38 24" filter="url(#goo)">
                                    <circle class="default" cx="12" cy="12" r="8" />
                                    <circle class="dot" cx="26" cy="12" r="8" />
                                </svg>
                            </label>
                        </div>
                    </td>
                    <td><button class="editBtn" wire:click="edit( '{{ encode( $i->id ) }}' )">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif

    @if($isOpen)
        <div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
            <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/3 overflow-y-auto right-0 w-full z-20">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                    <h2 class="font-bold w-full">Add / Update Author Meta</h2>
                    <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
                </div>
                <div class="h-70 md:h-full p-2">
                    <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="col-span-12">
                                <label for="name" class="formLabel">Name *</label>
                                <input type="text" wire:model="name" class="formInput" placeholder="Add Name" required/>
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="status" class="formLabel">Status *</label>
                                <select wire:model="status" class="formInput" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>
                                </select>
                                @error('status') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="bio" class="formLabel">Bio *</label>
                                <textarea  wire:model="bio" class="formInput" placeholder="Add Bio" style="min-height:150px" required></textarea>
                                @error('bio') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="image" class="formLabel">Image (300px X 250px) @if(!$media_id) * @endif </label>
                                <input type="file" wire:model="image" @if(!$media_id) required @endif>
                                @if($old_image) <img src="{{ $old_image }}" class="w-20 py-1" loading="lazy">@endif
                                @error('image') <span class="error">{{ $message }}</span> @enderror
                            </div>
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