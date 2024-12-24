<?php

namespace Deep\Admin\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Admin\Models\WalletRecharge;
use Livewire\WithPagination;

class AdminWalletRechargeHistory extends Component
{
    use WithPagination;

    public $user_id;
    
    public $perPage = 100, $search;

    public function mount( $id = null ){
        if( $id ){
            $this->user_id = decode( $id );
        }
    }

    public function render(){
        $query =   WalletRecharge::search($this->search)->orderBy('id', 'DESC');
        if( $this->user_id ){
            $query          =   $query->where('user_id', $this->user_id);
        }

        $data               =   $query->paginate($this->perPage);

        return view('deep::livewire.admin.admin-wallet-recharge-history', [ 'data' => $data ] )->layout('layouts.admin');
    }   

    protected $listeners = ['searchUpdated', 'perPageUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
}