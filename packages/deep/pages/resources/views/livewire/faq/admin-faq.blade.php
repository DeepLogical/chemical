<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Admin FAQ', 'routeName' => '', 'routeText' => 'Add FAQ', 'link' => true])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>#</th>
                <th>Model</th>
                <th>Page</th>
                <th>Quest</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index}}">
                    <td>{{ $loop->index +1}}</td>
                    <td>{{ $i->model }}</td>
                    <td>
                        <a href="{{ optional($i->page)->url }}" target="_blank">{{ optional($i->page)->name }}</a>
                    </td>
                    <td>{{ $i->quest}}</td>
                    <td>
                        <div class="gsap">
                            <label class="switch">
                                <input type="checkbox" wire:click="changeStatus('{{ encode($i->id) }}', '{{ encode($i->status) }}')" @if($i->status) checked @endif/>
                                <svg viewBox="0 0 38 24" filter="url(#goo)"><circle class="default" cx="12" cy="12" r="8"/><circle class="dot" cx="26" cy="12" r="8"/></svg>
                            </label>
                        </div>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($i->updated_at)->isoFormat('Do MMM YYYY')}}</td>
                    <td><button class="editBtn" wire:click="$dispatch( 'updateFaqModal', { id: '{{ encode( $i->id ) }}' } )">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif
    
    @livewire('faqModal')
</div>