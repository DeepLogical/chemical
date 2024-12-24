<?php

namespace Deep\Admin\Http\Livewire\User;

use Livewire\Component;

use DB;
use Deep\Admin\Models\WalletRecharge;
use Livewire\WithPagination;

class WalletRechargeHistory extends Component
{
    use WithPagination;

    public $perPage = 100, $search;

    public function render(){
        $data =   WalletRecharge::mine()->search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.user.wallet-recharge-history', [ 'data' => $data ] )->layout('layouts.admin');
    }

    protected $listeners = ['searchUpdated', 'perPageUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
}