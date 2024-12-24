$this->dispatch('check');

<script src="{{asset('/js/jquery-3.1.0.js')}}"></script>
<script>
    $(document).ready(function () {
        window.addEventListener('check', () => { 
            const modal = document.querySelector('.aspect-ratio-container');
            const modalWidth = modal.offsetWidth;
            const modalHeight = modal.offsetHeight;
            
            const modalContent = document.querySelector('.boxx');
            
            // Calculate the width and height based on ratios
            const height = 250 * parseInt( {{ $width / $height }} );

            modal.style.display = 'block';
            modalContent.style.height = `${height}px`;
        });
        });
</script>

<div class="flex items-center">
    <div class="threeDots">
        <img src="/images/icons/static/action.svg">
        <div class="dotOptions" style="display:none">
            <button wire:click="openModal( {{ encode( $i->id ) }} )">Edit</button>
            <a href="{{ route('userWalletRechargeHistory', ['id' => encode($i->id)] ) }}">Recharge History</a>
        </div>
    </div>
</div>

$this->dispatch('redirect', [ "route" =>  route('downloadInvoice') ]);
<script>
    window.addEventListener('redirect', (e) => { window.open(e.detail.route, '_blank'); }); 
</script>

'status'                        => !$this->data_id ? 1 : $this->status,

wire:click="$emit('postAdded')"

$this->dispatch('addressSelected', $entry->id);

updateOrCreate(['id' => $this->data_id], [


$today = \Carbon\Carbon::now()->format('Y-m-d');

$this->dispatch('openURL', [ 'data' => $url ]);
window.addEventListener('openURL', e => {
    window.open(e.detail.data, "_blank");    
});
href="{{ route('updateblog', ['id' => encode( $i->id )] ) }}"
{{ route('updateblog', ['url' => $i->url] ) }}


return redirect(route('404') );
return redirect(route('adminblog') );
<td><a class="editBtn" href="{{ route('updateblog', ['id' => encode( $i->id )] ) }}">Edit</a></td>
<td><button class="editBtn" wire:click="edit( '{{ encode( $i->id ) }}' )">Edit</button></td>

{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('Do MMM YYYY') }}
{{ $i->updated_at->diffForHumans() }}

'email'                 => 'required|email',
'phone'                 => 'required|numeric|digits:10',
'address_id'            => 'required|numeric'

<div class="col-span-12 md:col-span-6">
    <label class="formLabel">Status *</label>
    <select wire:model="status" class="formInput" required>
        <option value="">Select Status</option>
        <option value="1">Show</option>
        <option value="0">Hide</option>
    </select>
    @error('status') <span class="error">{{ $message }}</span> @enderror
</div>
<div class="col-span-12 md:col-span-6">
    <label class="formLabel">Display Order</label>
    <input type="number" wire:model="display_order" class="formInput" placeholder="Add Display Order">
    @error('display_order') <span class="error">{{ $message }}</span> @enderror
</div>



<div class="col-span-12">
    <label class="formLabel">Image (1200px X 450px) *</label>
    <input type="file" wire:model="image" @if(!$data_id) required @endif>
    @error('image') <span class="error">{{ $message }}</span> @enderror
</div>

<td>
    <div class="gsap">
        <label class="switch">
            <input type="checkbox" wire:click="changeStatus('{{ encode($i->id) }}', '{{ encode($i->status) }}')" @if($i->status) checked @endif/>
            <svg viewBox="0 0 38 24" filter="url(#goo)"><circle class="default" cx="12" cy="12" r="8"/><circle class="dot" cx="26" cy="12" r="8"/></svg>
        </label>
    </div>
</td>

public function changeStatus($id, $status){
    $message = changeStatus('job_openings', 'status', $id, $status);
    $this->dispatch('alert', ['type' => 'success',  'message' => $message ]);
}


<div wire:ignore class="col-span-6">
    <label class="formLabel">Category</label>
    <select class="formInput" wire:model="catSelected" id="selectCat" multiple>
        @foreach($catOptions as  $i)<option value="{{ $i->id}}" wire:key="catOptions-{{ $loop->index }}">{{ $i->name }}</option>@endforeach
    </select>
</div>
<div wire:ignore class="col-span-6">
    <label class="formLabel">Tags</label>
    <select class="formInput" id='selectTag' wire:model="tagSelected" multiple>
        @foreach($tagOptions as  $i)<option value="{{ $i->id}}" wire:key="tagOptions-{{ $loop->index }}">{{ $i->name }}</option>@endforeach
    </select>
</div>

<div wire:ignore class="col-span-12 md:col-span-6">
    <label class="formLabel">Course Short Decription *</label>
    <textarea wire:model="short_desc" class="form-control" name="short_desc" id="short_desc" required></textarea>
</div>
<div wire:ignore class="col-span-12 md:col-span-6">
    <label class="formLabel">Long Description *</label>
    <textarea wire:model="long_desc" class="form-control" name="long_desc" id="long_desc" required></textarea>
</div>



<script>
    const editor = CKEDITOR.replace('short_desc'); editor.on('change', function(event){ @this.set('short_desc', event.editor.getData()); });
    const editor2 = CKEDITOR.replace('long_desc'); editor2.on('change', function(event){ @this.set('long_desc', event.editor.getData()); });
    $(document).ready(function() { 
        $('#selectCat').select2({ placeholder: "Select Categories", allowClear: true }).on('change', function (e) {
            var data = $('#selectCat').select2("val"); @this.set('catSelected', data); });
        $('#selectTag').select2({ placeholder: "Select Tags", allowClear: true }).on('change', function (e) {
            var data = $('#selectTag').select2("val"); @this.set('tagSelected', data); });
    });
</script>

@if($data)<div class="paginate">{{ $data->links() }}</div>@endif