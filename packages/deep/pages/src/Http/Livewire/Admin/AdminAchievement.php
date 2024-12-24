<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use Deep\Pages\Models\Achievement;
use Livewire\WithPagination;

class AdminAchievement extends Component
{
    use WithPagination;
    public $perPage = 50, $search, $counter = 0;

    public function render(){
        $achievements = Achievement::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        $data = $achievements->groupBy('model_id');
        $paginationLinks = $achievements->appends(request()->except('page'))->links();
        return view('deep::livewire.admin.admin-achievement', [ "data" => $data, "paginationLinks" => $paginationLinks ])->layout('layouts.admin');
    }

    public function changeStatus( $model, $model_id, $status ){
        Achievement::where([ ['model', $model], ['model_id', decode( $model_id )] ])->update([
            'status'            =>  decode($status) ? 0 : 1
        ]);
        $this->dispatch('alert', ['type' => 'success',  'message' => "Achievement Status Updated Successfully"]);
    }
    
    protected $listeners = [ 'searchUpdated', 'perPageUpdated', 'openModalCalled', 'achievementModalUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->dispatch('openAchievementModal'); }
    public function achievementModalUpdated(){ $this->counter++; }
}