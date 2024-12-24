<div>
    @livewire('adminSearch', ['page' => 'Admin Meta', 'routeName' => '', 'routeText' => 'Add Meta', 'link' => 'true'])

    <div class="flex">
        <button class="editBtn" wire:click="uploadExcel()">Upload Meta</button>
        <button class="editBtn" wire:click="fileExport()">Export Meta</button>
    </div>

    <div class="flex">
        @foreach($pendingMeta as $i)<a wire:key="pendingMeta-{{ $loop->index }}" class="editBtn" href="{{ $i}}" target="_blank">{{ $i}}</a>@endforeach
    </div>

    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>URL</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td><a href="{{ $i->url }}" target="_blank">{{ $i->url }}</a></td>
                    <td class="{{ strlen( $i->title ) < 40 || strlen( $i->title ) > 60 ? 'bg-action text-white ' : 'px-1 py-1' }}">{{ $i->title }} - {{ strlen( $i->title ) }}</td>
                    <td class="{{ strlen( $i->description ) < 140 || strlen( $i->description ) > 155 ? 'bg-action text-white ' : 'px-1 py-1' }}">{{ $i->description}} - {{ strlen( $i->description ) }}</td>
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
                    <h2 class="font-bold w-full">Add / Update Meta</h2>
                    <img wire:click="closeModal()" src="/images/icons/static/cross.svg" class="h-6 w-6 ml-auto hover:cursor-pointer">
                </div>
                <div class="h-70 md:h-full p-2">
                    <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="col-span-12">
                                <label for="url" class="formLabel">URL *</label>
                                <input type="text" wire:model.lazy="url" class="formInput" placeholder="Add Slug" required>
                                @error('url') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="title" class="formLabel {{ strlen( $title ) < 50 || strlen( $title ) > 60 ? 'text-action font-bold' : '' }}">Title * - {{ strlen( $title ) }}</label>
                                <textarea  wire:model="title" class="formInput" placeholder="Add Title" style="min-height: 100px" required></textarea>
                                @error('title') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="description" class="formLabel {{ strlen( $description ) < 140 || strlen( $description ) > 155 ? 'text-action font-bold ' : '' }}">Description * - {{ strlen( $description ) }}</label>
                                <textarea  wire:model="description" class="formInput" placeholder="Add Description" style="min-height: 200px" required></textarea>
                                @error('description') <span class="error">{{ $message }}</span> @enderror
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

    @if($isOpenExcel)
        <div class="bg-dark fixed h-full left-0 top-0 w-full z-50">
            <div class="bg-white animated fade border bottom-0 fixed h-70 md:h-full md:w-1/3 overflow-y-auto right-0 w-full z-20">
                <div class="flex bg-gray-100 border-b py-2 px-2 items-center justify-center">
                    <h2 class="font-bold w-full">Upload Meta by Excel</h2>
                    <img src="{{ asset('/images/icons/static/cross.svg') }}" class="closeAuthModel ml-auto hover:cursor-pointer h-6 w-6" wire:click="closeModal()">
                </div>
                <div class="h-70 md:h-full p-2">
                    <form wire:submit.prevent="submitExcel" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="col-span-12">
                                <label for="excelFile" class="formLabel">Upload Meta by Excel *</label>
                                <input type="file" wire:model="excelFile" required>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button class="btn w-full" wire:loading.remove>Submit</button>
                            <span wire:loading class="btn w-full">Submit</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>