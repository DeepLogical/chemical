<div class="py-10">
    <p class="text-center font-thin">Share views on <span class="font-bold">{{ $title }}</span></p>
    <p class="mb-5">Please keep your views respectful and not include any anchors, promotional content or obscene words in them. Such comments will be definitely removed and your IP be blocked for future purpose.</p>
    <form wire:submit.prevent="submit" method="POST" class="amitBtnGroup" autocomplete="off">
        <div class="row">
            <div class="col-span-12 md:col-span-6">
                <label for="name" class="formLabel">Name</label>
                <input type="text" wire:model="name" class="formInput" placeholder="Add Name" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-6">
                <label for="email" class="formLabel">Email</label>
                <input type="text" wire:model="email" class="formInput" placeholder="Add Email" required>
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12">
                <label for="comment" class="formLabel">Comment</label>
                <textarea wire:model="comment" class="formInput h-40" placeholder="Add Comment" required></textarea>
                @error('comment') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="text-center mt-5">
            <button type="submit" class="btn"  wire:loading.remove>Submit</button>
            <span wire:loading class="btn">Submit</span>
        </div>
    </form>
    @if( $comments && count($comments) )
        <h3 class="text-center mt-10 mb-4 text-base font-semibold text-gray-900"> <strong>{{ count($comments) }}</strong> views on <span class="font-bold">{{ $title }}</span></h3>
        <div class="space-y-4">
            @foreach($comments as $i)
                <div wire:key="comment-{{ $loop->index }}" class="mb-5 py-5 border-b-2">
                    <div class="flex items-center">
                        <div class="mr-1 bg-action rounded-full flex items-center justify-center" style="height: 40px; width: 40px">
                            <p class="font-bold text-white text-xl">{{ substr($i->name, 0, 1) }}</p>
                        </div>
                        <div>
                            <p class="leading-4"><strong>{{ $i->name }}</strong> says</p>
                            <small>{{ $i->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <p class="py-2 relative text-sm">{{ $i->comment }}</p>
                    <button wire:click="openModal({{ $i->id}})">Reply</button>
                    @if( $comment_id == $i->id )
                        <form wire:submit.prevent="submit" method="POST" autocomplete="off">
                            <div class="row">
                                <div class="col-span-12 md:col-span-6">
                                    <label for="name" class="formLabel">Name</label>
                                    <input type="text" wire:model="name" class="formInput" placeholder="Add Name" required>
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label for="email" class="formLabel">Email</label>
                                    <input type="text" wire:model="email" class="formInput" placeholder="Add Email" required>
                                </div>
                                <div class="col-span-12">
                                    <label for="comment" class="formLabel">Comment</label>
                                    <textarea wire:model="comment" class="formInput h-40" placeholder="Add Comment" required></textarea>
                                    @error('comment') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="text-center mt-5">
                                    <button type="submit" class="btn"  wire:loading.remove>Submit</button>
                                    <span wire:loading class="btn">Submit</span>
                                </div>
                            </div>
                        </form>
                    @endif
                    
                    @if( $i->response && count( $i->response) )
                        @foreach( $i->response as $j )
                            <div wire:key="response-{{ $loop->index }}" class="pl-0 md:pl-10 mt-5">
                                <div class="flex items-center">
                                    <div class="mr-1 bg-action rounded-full flex items-center justify-center" style="height: 40px; width: 40px">
                                        <p class="font-bold text-white text-xl">{{ substr($j->name, 0, 1) }}</p>
                                    </div>
                                    <div>
                                        <p class="leading-4"><strong>{{ $j->name }}</strong> says</p>
                                        <small>{{date('d-m-Y', strtotime($j->updated_at)) }}</small>
                                    </div>
                                </div>
                                <p class="py-2 relative text-sm">{!! $j->comment !!}</p>
                                <button wire:click="openModal({{ $i->id}})" class="text-sm">Reply</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>