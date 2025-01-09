<div>
    @livewire('adminSearch', ['page' => 'Admin Product', 'routeName' => 'addUpdateProduct', 'link' => '', 'routeText' => 'Add Product'])
    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>#</th>
                <th>Product // Image</th>
                <th>Manufacturer</th>
                <th>Functions</th>
                <th>TDS</th>
                <th>end</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead> 
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index }}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>
                    <img src="/storage/product/{{ optional($i->media)->media}}" class="w-32" loading="lazy">
                    {{ $i->name }}
                    </td>
                    <td>{{ $i->manufacturer}}</td>
                    <td>{{ $i->functions}}</td>
                    <td>{{ $i->tds}}</td>
                    <td>{{ $i->end}}</td>
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
                    <td>
                        <div class="flex items-center">
                            <div class="threeDots">
                                <img src="/images/icons/static/action.svg">
                                <div class="dotOptions" style="display:none">
                                    <a href="{{ route('addUpdateProduct', ['id' => encode($i->id)] ) }}">Edit</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif
    
</div>