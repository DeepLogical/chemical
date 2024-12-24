<div>
    @livewire('adminSearch', [ 'perPage' => $perPage, 'page' => 'Staff', 'routeName' => '', 'routeText' => 'Add Staff', 'link' => 'true'])

    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($data)
                @foreach($data as $i)
                    <tr wire:key="data-{{$loop->index}}">
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{ optional($i->staff)->name }}<br/>{{ optional($i->staff)->email }} || {{ optional($i->staff)->phone }}</td>
                        <td>@foreach( optional($i->staff)->roles as $j) {{ ucwords($j->name) }} @if( !$loop->last ), @endif @endforeach</td>
                        <td>@foreach( optional($i->staff)->permissions as $j) {{ ucwords($j->name) }} @if( !$loop->last ), @endif @endforeach</td>
                        <td>
                            <div class="gsap">
                                <label class="switch">
                                    <input type="checkbox" wire:click="changeStatus('{{ encode($i->id) }}', '{{ encode($i->status) }}')" @if($i->status) checked @endif/>
                                    <svg viewBox="0 0 38 24" filter="url(#goo)"><circle class="default" cx="12" cy="12" r="8"/><circle class="dot" cx="26" cy="12" r="8"/></svg>
                                </label>
                            </div>
                        </td>
                        <td><a href="{{ route('userSpatie', ['id' => encode( $i->staff_id )] ) }}" class="editBtn">Assign Role & Permissions</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if($data)<div class="paginate">{{ $data->links() }}</div>@endif

    @livewire('createUserModal', [ "redirect" => 0, "role" => "staff"])
</div>