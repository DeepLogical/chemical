<div>
    @livewire('adminSearch', [ 'perPage' => isset($perPage), 'page' => 'Admin Achievements', 'routeName' => '', 'routeText' => 'Add Achievement', 'link' => 'true'])

    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Page</th>
                <th>Achievement</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i)
                <tr wire:key="data-{{ $loop->index}}">
                    <td>{{ $loop->index +1 }}</td>
                    <td>
                        @if( count($i) )
                            {{ optional($i[0]->page)->name }}
                        @endif
                    </td>
                    <td>
                        @foreach( $i as $j ) 
                            <div class="flex mb-2">
                                <img src="{{ optional($j->media)->path }}" class="w-12 mr-2">
                                {{ $j->name }} - {{ $j->value }}
                            </div>
                        @endforeach</td>
                    <td>
                        <div class="gsap">
                            <label class="switch">
                                <input type="checkbox" wire:click="changeStatus( '{{ $i[0]->model }}', '{{ encode($i[0]->model_id )}}', '{{ encode($i[0]->status )}}')" @if( $i[0]->status ) checked @endif/>
                                <svg viewBox="0 0 38 24" filter="url(#goo)"><circle class="default" cx="12" cy="12" r="8"/><circle class="dot" cx="26" cy="12" r="8"/></svg>
                            </label>
                        </div>
                    </td>
                    <td><button class="editBtn" wire:click="$dispatch ('updateAchievementModal', { 'model' : '{{ $i[0]->model }}', 'model_id' :'{{ encode( $i[0]->model_id ) }}' })">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($data)<div class="paginate">{!! $paginationLinks !!}</div>@endif

    @livewire('achievementModal')
</div>