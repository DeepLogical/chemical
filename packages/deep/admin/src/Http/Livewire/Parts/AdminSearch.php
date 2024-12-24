<?php

namespace Deep\Admin\Http\Livewire\Parts;

use Livewire\Component;

use Illuminate\Support\Facades\Route;

class AdminSearch extends Component
{
    public $page, $search, $showSearch =1, $perPage = 100, $routeName, $link, $routeText, $showDates, $currentRoute, $links = [], $parent, $data = [];
    public $page_options = [10, 25, 50, 100, 1000];

    public function mount( $currentRoute = null ){
        $this->data = getAdminLinks();
        $this->currentRoute = $currentRoute ? $currentRoute : Route::currentRouteName();

        if ($this->currentRoute) {
            foreach ($this->data as $item) {
                if (isset($item['sublinks'])) {
                    $key = array_search($this->currentRoute, array_column($item['sublinks'], 'link'));
                    if ($key !== false) {
                        $this->links = $item['sublinks'];
                        $this->parent = $item['link'];
                        break;
                    }
                }
            }
        }
    }

    public function render(){ return view('deep::livewire.parts.admin-search')->layout('layouts.admin'); }

    public function searchClicked(){
        $this->showSearch               =   1;

        if( !$this->search ){
            return;
        }

        $this->dispatch('searchUpdated', $this->search);
    }

    // public function updatedSearch(){ $this->dispatch('searchUpdated', $this->search); }
    public function updatedPerPage(){ $this->dispatch('perPageUpdated', $this->perPage); }
    public function openModal(){ $this->dispatch('openModalCalled'); }
}