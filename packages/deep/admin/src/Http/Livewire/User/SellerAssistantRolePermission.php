<?php

namespace Deep\Ecom\Http\Livewire\Vendor;

use Livewire\Component;

use DB;
use App\Models\User;
use Deep\Ecom\Models\MyStaff;

use Livewire\WithPagination;

class SellerAssistantRolePermission extends Component
{
    use WithPagination;

    public $vendor_id, $user_id, $user, $staff;
    public $sortBy = 'id', $sortDirection = 'desc', $perPage = 100, $search;

    public function mount( $id ){
        $this->user_id                      =   decode( $id );
        $this->vendor_id                    =   getVendorId();
        $this->user                         =   User::where('id', $this->user_id)->first();

        $this->staff                        =   SellerAssistant::where([ ['user_id', $this->user_id], ['vendor_id', $this->vendor_id] ])->first();

        if( !$this->user || !$this->staff ){ return redirect(route('404') ); }
    }

    public function render(){
        return view('deep::livewire.vendor.seller-assistant-role-permission')->layout('layouts.admin');
    }
    
    public function submit(){
        
    }
}