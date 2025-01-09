<?php

namespace Deep\Products\Http\Livewire\Admin;

use Livewire\Component;
use Deep\Products\Models\Product;
use Deep\Pages\Models\Pages;
use Deep\Products\Models\Productmeta;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Image; // Added the Image class import

class AddUpdateProduct extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $status, $manufacturer, $meta_id, $media_id, $image, $old_image, $data_id, $functions, $end, $tds, $url;
    public $tagSelected = [], $tagOptions = [], $catSelected = [], $catOptions = [];
    public $isOpen = 0, $perPage = 100, $search;
    public $images = [];
    public $links = [
        [ "name" => "Products", "link" => "adminProduct" ],
        [ "name" => "Productmeta", "link" => "adminProductmeta" ],
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->data_id = decode($id);
            $data = Product::find($this->data_id);

            if (!$data) {
                return redirect(route('404'));
            }

            $this->name = $data->name;
            $this->url = $data->url;
            $this->manufacturer = $data->manufacturer;
            $this->functions = $data->functions;
            $this->end = $data->end;
            $this->tds = $data->tds;
            $this->media_id = optional($data->media)->id;
            $this->meta_id = optional($data->meta)->id;
            $this->old_image = optional($data->media)->path;

            $catArray = [];
            $tagArray = [];
            foreach ($data->productmeta as $i) {
                if ($i->type === "category") {
                    array_push($catArray, $i->id);
                }
                if ($i->type === "tag") {
                    array_push($tagArray, $i->id);
                }
            }
            $this->catSelected = $catArray;
            $this->tagSelected = $tagArray;
        }

        $this->catOptions = Productmeta::select('id', 'name')->where('type', 'category')->get();
        $this->tagOptions = Productmeta::select('id', 'name')->where('type', 'tag')->get();
    }

    public function render(){ return view('deep::livewire.admin.add-update-product')->layout('layouts.admin'); }

    public function edit($id)
    {
        $this->data_id = decode($id);
        $check = Product::where('id', $this->data_id)->first();

        if ($check) {
            $this->name = $check->name;
            $this->manufacturer = $check->manufacturer;
            $this->end = $check->end;
            $this->functions = $check->functions;
            $this->tds = $check->tds;
            $this->status = $check->status;
            $this->old_image = optional($check->media)->path;
            $this->media_id = $check->media_id;
            $this->isOpen = true;
        }
    }

    private function resetInputFields()
    {
        $this->name = null;
        $this->manufacturer = null;
        $this->end = null;
        $this->functions = null;
        $this->tds = null;
        $this->status = null;
        $this->media_id = null;
        $this->data_id = null;
        $this->isOpen = false;
        $this->image = null;
        $this->old_image = null;
    }

    public function changeStatus($id, $status)
    {
        $message = changeStatus('products', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success', 'message' => $message]);
       
    }


    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'url' => 'required',
            'manufacturer' => 'required',
            'functions' => 'required',
            'end' => 'required',
            'tds' => 'required',
        ]);

        if (!$this->media_id) {
            $this->validate([
                'image' => 'required | image | max:2048',
            ]);
        }

        DB::transaction(function () {
            $url = sanitizeURL($this->url);

            if ($this->image) {
                $this->media_id = addOrUpdateSingleImage($this->image, 'product', $this->name, $url, $this->media_id);
            }

            $entry = Product::updateOrCreate(['id' => $this->data_id], [
                'name' => $this->name,
                'url' => $url,
                'media_id' => $this->media_id,
                'status' => 1,
                'manufacturer' => $this->manufacturer,
                'functions' => $this->functions,
                'end' => $this->end,
                'tds' => $this->tds,
            ]);

            $productMeta = [];
            foreach ($this->catSelected as $i) {
                array_push($productMeta, (int)$i);
            }
            foreach ($this->tagSelected as $i) {
                array_push($productMeta, (int)$i);
            }

            $productMeta = array_merge($this->catSelected, $this->tagSelected);
            pivotEntry('product_productmeta', $entry->id, $productMeta, 'product_id', 'productmeta_id');
            $check = Product::select('url')->findOrFail($entry->id);
            if ($check) {
                addOrUpdateMeta($check->url, $this->name, $this->meta_id, $this->media_id);
            }

            $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? 'Product Updated Successfully.' : 'Product Created Successfully.']);
        }, 3);
        return redirect(route('adminProduct'));
    }

    
}