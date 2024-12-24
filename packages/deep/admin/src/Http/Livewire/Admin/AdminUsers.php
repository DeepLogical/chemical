<?php

namespace Deep\Admin\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use App\Models\User;
use Deep\Coupon\Models\Coupon;
use Deep\Cab\Models\UserDiscount;
use Livewire\WithPagination;

class AdminUsers extends Component
{
    use WithPagination;

    public $couponSelected = [], $couponOptions = [], $roleOptions, $role, $role_id, $discount, $discount_type = 'percent', $name, $company, $remarks, $data_id;
    public $isOpen = false, $perPage = 100, $search;

    public function mount(){
        $this->roleOptions                  =   \Spatie\Permission\Models\Role::all();
        // $this->couponOptions                =   Coupon::where([ ['coupon_type', 'For User'] ])->active()->get();
        clearUnverifiedUsers();
    }

    public function render(){
        $query          =   User::select('id', 'name', 'email', 'phone', 'wallet', 'email_verified_at', 'updated_at')
                            ->search($this->search)->orderBy('id', 'DESC');
        if( $this->role ){
            $query      =   $query->role($this->role);
        }

        $data           =   $query->paginate($this->perPage);

        return view('deep::livewire.admin.admin-users', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'role_id' => 'required',
        ]);

        DB::transaction(function () {
            DB::table('model_has_roles')->updateOrInsert(
                ['model_id' => $this->data_id],
                [
                    'model_type'    =>  'App\Models\User',
                    'role_id'       =>  $this->role_id,
                ]
            );

            // pivotEntry('coupon_user', $this->data_id, $this->couponSelected, 'user_id', 'coupon_id');

            // DB::table('user_discounts')->where('user_id', $this->data_id)->delete();
            // UserDiscount::create([
            //     'user_id'               =>  $this->data_id,
            //     'type'                  =>  $this->discount_type ? : 'percent',
            //     'discount'              =>  $this->discount,
            //     'status'                =>  1
            // ]);

            $this->dispatch('alert', ['type' => 'success',  'message' => 'User Updated Successfully.' ]);
            $this->closeModal();
        }, 3);
    }

    public function openModal( $id ){
        $this->data_id          =   decode( $id );
        $check                  =   User::where('id', $this->data_id)->first();

        if( $check ){
            $this->name                     =   $check->name;
            $this->discount                 =   optional($check->discount)->discount;
            $this->discount_type            =   optional($check->discount)->type;
            $this->role_id                  =   $check->roles->first()->id;
            $this->isOpen                   =   1;
        }
    }
    
    private function resetInputFields(){
        $this->role                     =   null;
        $this->role_id                  =   null;
        $this->name                     =   null;
        $this->discount                 =   null;
        $this->discount_type            =   null;
        $this->company                  =   null;
        $this->remarks                  =   null;
        $this->data_id                  =   null;
        $this->isOpen                   =   false;
    }

    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; } 
}