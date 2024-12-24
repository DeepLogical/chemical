<?php

namespace Deep\Admin\Http\Livewire\User;

use Livewire\Component;

use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Deep\Admin\Models\MyStaff;
use Livewire\WithPagination;

class UserSpatie extends Component
{
    use WithPagination;
    
    public $isOpen = 0, $perPage = 100, $search, $sortBy = 'id', $sortDirection = 'desc';
    public $staff_id, $user, $permissions = [], $permissionSelected = [], $role_options = [], $role, $status, $data;

    public function mount( $id ){
        $this->staff_id                         =   decode( $id );

        $this->data          =   MyStaff::where([ ['staff_id', $this->staff_id] ])->first();

        $this->permissions              =   Permission::orderBy('name', 'ASC')->get();
        $this->role_options             =   Role::whereIn('id', [14, 13])->orderBy('name', 'ASC')->get();
        $this->status                   =   $this->data->status;   
        $this->role                     =   optional(optional(optional($this->data->staff)->roles)->first())->id;
        $this->permissionSelected       =   DB::table('model_has_permissions')->where('model_id', $this->staff_id)->pluck('permission_id')->toArray();
    }

    public function render(){
        return view('deep::livewire.user.user-spatie')->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'role'                          =>  'required|numeric',
            'status'                        =>  'required|numeric',
        ]);

        try{
            DB::transaction(function () {
                MyStaff::where([ ['staff_id', $this->staff_id] ])->update([
                    'status'                        =>  $this->status
                ]);
        
                DB::table('model_has_roles')->where('model_id', $this->staff_id)->update([
                    'role_id'                   =>  $this->role,
                ]);
        
                DB::table('model_has_permissions')->where('model_id', $this->staff_id)->delete();

                if( $this->role != 'user' ){
                    foreach( $this->permissionSelected as $i ){
                        DB::table('model_has_permissions')->insert([
                            'model_id'                      =>  $this->staff_id,
                            'permission_id'                 =>  $i,
                            'model_type'                    =>  'App\Models\User'
                        ]);
                    }
                }
        
                $this->dispatch('alert', ['type' => 'success', 'message' => 'Employee Updated Successfully.' ]);

                return redirect(route('myStaffList') );
            }, 3);
        }catch (Exception $e) { \Log::warning("Error In User Spatie ".$e->getMessage() ); }
    }
}