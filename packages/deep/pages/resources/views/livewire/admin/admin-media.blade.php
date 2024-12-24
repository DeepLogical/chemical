<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Admin Media', 'routeName' => '', 'routeText' => 'Add Media', 'link' => 'true'])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Media</th>
                <th>Alt || Path</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index}}">
                    <td>{{ $loop->index +1}}</td>
                    <td>
                        <a href="{{ $i->path}}" target="_blank" class="text-center block">
                            @if( str_contains($i->path, '.pdf') )
                                PDF
                            @else
                                <img src="{{ $i->path}}" class="w-20 mx-auto" loading="lazy"/>
                            @endif
                        </a>
                    </td>
                    <td>{{ $i->alt}} <br/>{{ $site }}{{ $i->path}}</td>
                    <td><button class="editBtn" wire:click='edit( {{ json_encode( $i ) }} )'>Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif
    
    @if($isOpen)
        <div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
            <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/2 overflow-y-auto right-0 w-full z-20">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                    <h2 class="font-bold w-full">Add / Update Masters</h2>
                    <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
                </div>
                <div class="h-70 md:h-full p-2">
                    <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                        <div class="grid grid-cols-12 gap-4">
                            @if(!$mediaId)
                                <div class="col-span-12">
                                    <label class="formLabel">Image</label>
                                    <input type="file" wire:model.defer="image" @if(!$mediaId) required @else readonly @endif>
                                    @if($old_image) <img src="{{ $path}}" class="w-20 py-1"> @endif
                                    @error('image') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            @endif
                            <div class="col-span-12">
                                <label class="formLabel">Alt</label>
                                <input type="text" wire:model.defer="alt" class="formInput" placeholder="Add ALT" required>
                                @error('alt') <span class="error">{{ $message }}</span> @enderror
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