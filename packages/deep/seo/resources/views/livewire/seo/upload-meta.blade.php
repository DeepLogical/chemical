<div>
    @livewire('adminSearch', [ 'perPage' => $perPage, 'page' => 'Meta Uploaded', 'routeName' => '', 'routeText' => 'Clear Interface', 'link' => 'true'])

    <div class="row mb-2">
        <div class="col-span-12 md:col-span-9"></div>
        <div class="col-span-12 md:col-span-3">
            <label class="formLabel">Status</label>
            <select wire:model="status" class="formInput">
                <option value="">Select Status</option>
                @foreach( $status_options as $i )<option value="{{ $i }}">{{ $i }}</option> @endforeach
            </select>
            @error('status') <span class="error">{{ $message }}</span> @enderror
        </div>
    </div>

    <table class="admin min-w-full table-auto">
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>URL</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @if($data)
                @foreach($data as $i)
                    <tr wire:key="data-{{ $loop->index }}" class="@if($i->status != 'Success' ) ? bg-action text-white @endif">
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{ $i->url }}</td>
                        <td>{{ $i->title }}</td>
                        <td>{{ $i->description }}</td>
                        <td>{{ $i->status }}</td>
                        <td>{!! $i->message !!}</td>
                        <td>{{ \Carbon\Carbon::parse($i->updated_at)->isoFormat('Do MMM YYYY') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>