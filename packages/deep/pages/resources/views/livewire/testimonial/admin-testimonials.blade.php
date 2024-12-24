<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Admin Testimonials', 'routeName' => '', 'routeText' => 'Add Testimonials', 'link' => 'true'])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>#</th>
                <th>Page</th>
                <th>Image</th>
                <th>Testis</th>
                <th>Client</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index}}">
                    <td>{{ $loop->index +1}}</td>
                    <td>
                        <a href="/{{ $i->url }}" target="_blank">
                            <img src="/storage/testimonials/{{ optional($i->media)->media}}" class="w-32" loading="lazy">
                            {{ $i->name }}
                        </a>
                    </td>
                    <td class="hover:cursor-pointer">
                        <a href="{{ optional($i->page)->url }}" target="_blank">{{ optional($i->page)->name }}</a>
                    </td>
                    <td>{!! $i->testis !!}</td>
                    <td>{{ $i->name }}<br/>{{ $i->role }}</td>
                    <td>
                        <div class="gsap">
                            <label class="switch">
                                <input type="checkbox" wire:click="changeStatus('{{ encode($i->id) }}', '{{ encode($i->status) }}')" @if($i->status) checked @endif/>
                                <svg viewBox="0 0 38 24" filter="url(#goo)"><circle class="default" cx="12" cy="12" r="8"/><circle class="dot" cx="26" cy="12" r="8"/></svg>
                            </label>
                        </div>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($i->updated_at)->isoFormat('Do MMM YYYY')}}</td>
                    <td><button class="editBtn" wire:click="$dispatch( 'updateTestimonialModal', { id: '{{ encode( $i->id ) }}' } )">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif

    @livewire('testimonialModal')
</div>