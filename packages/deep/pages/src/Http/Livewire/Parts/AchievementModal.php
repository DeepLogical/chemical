<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use DB;
use Deep\Pages\Models\Pages;
use Deep\Pages\Models\Achievement;
use Livewire\WithFileUploads;

class AchievementModal extends Component
{
    use WithFileUploads;

    public $model, $model_id, $model_options = [], $name, $value, $status, $data_id;
    public $isOpen = 0, $initModal = 0, $perPage = 100, $search;
    public $achievement = [
        [ "id" => null, "name" => "", "value" => "", "image" => null, "old_image" => null, "media_id" => null ],
        [ "id" => null, "name" => "", "value" => "", "image" => null, "old_image" => null, "media_id" => null ],
        [ "id" => null, "name" => "", "value" => "", "image" => null, "old_image" => null, "media_id" => null ],
        [ "id" => null, "name" => "", "value" => "", "image" => null, "old_image" => null, "media_id" => null ],
    ];

    public function render(){ return view('deep::livewire.parts.achievement-modal')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            'model'                         => 'required',
            'model_id'                      => 'required|numeric',
            'status'                        => 'required',
        ]);

        DB::transaction(function () {
            foreach( $this->achievement as $key => $i ){
                if( $i['image'] ){
                    $media_id = addOrUpdateSingleImage( $i['image'], 'achievements', $i['name'], $i['name'], $i['media_id'] );
                    $this->achievement[$key]['media_id']                    =   $media_id;
                }
            }

            foreach( $this->achievement as $i ){
                Achievement::updateOrCreate(['id' => $i['id']], [
                    'model'                 =>  $this->model,
                    'model_id'              =>  $this->model_id,
                    'media_id'              =>  $i['media_id'],
                    'name'                  =>  $i['name'],
                    'value'                 =>  $i['value'],
                    'status'                =>  $this->status,
                ]);
            }

            $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Achievement Updated Successfully.' : 'Achievement Created Successfully.' ]);
            $this->resetInputFields();

            $this->dispatch('achievementModalUpdated');
        }, 3);
    }

    public function closeModal(){ $this->resetInputFields(); $this->dispatch('refreshComponent'); }
    protected $listeners = [ 'createAchievementModal', 'openAchievementModal', 'updateAchievementModal', 'refreshComponent'=> '$refresh' ];

    public function createAchievementModal($model, $id){
        $this->resetInputFields();
        $this->model                        =   $model;
        $this->model_id                     =   decode( $id );
        $this->status                       =   1;
        $this->isOpen                       =   1;
    }

    public function openAchievementModal(){
        $this->resetInputFields();
        $this->status                       =   1;
        $this->isOpen                       =   1;
        $this->initModal                =   1;
        $this->updatedModel();
    }

    public function updateAchievementModal( $model, $model_id ){
        $check                              =   Achievement::where([ ['model', $model], ['model_id', decode( $model_id )] ])->get();

        if( !$check || !count( $check ) ){ return; }

        $this->model                        =   $model;
        $this->model_id                     =   decode( $model_id );
        if( $check && count($check ) ){
            $array = [];
            foreach( $check as $i ){
                $array[] = [ "id" => $i->id, "name" => $i->name, "value" => $i->value, "media_id" => $i->media_id, "old_image" => optional($i->media)->path, "image" => null ];
            }
            $this->achievement          = $array;

        }
        
        $this->status                   =   $check->first()->status;
        $this->data_id                  =   $check->first()->id;
        $this->isOpen                   =   true;
    }

    public function updatedModel(){
        $this->model_id             = null;
        if( $this->model == "Page" ){
            $this->model_options = Pages::select('id', 'name')->orderBy('name', 'ASC')->get();
        }
    }

    private function resetInputFields(){
        $this->initModal                =   null;
        $this->model                    =   null;
        $this->model_id                 =   null;
        $this->data_id                  =   null;
        $this->isOpen                   =   false;
        $this->achievement = [
            [ "id" => null, "name" => "", "value" => "", "image" => null, "old_image" => null, "media_id" => null ],
            [ "id" => null, "name" => "", "value" => "", "image" => null, "old_image" => null, "media_id" => null ],
            [ "id" => null, "name" => "", "value" => "", "image" => null, "old_image" => null, "media_id" => null ],
            [ "id" => null, "name" => "", "value" => "", "image" => null, "old_image" => null, "media_id" => null ],
        ];
    }
}