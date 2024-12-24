<?php

namespace Deep\Seo\Http\Livewire\Seo;

use Livewire\Component;

use DB;
use Deep\Seo\Models\Meta;
use Deep\Blogs\Models\Blog;
use Deep\Blogs\Models\Blogmeta;

use Excel;
use Deep\Seo\Exim\MetaImport;
use Deep\Seo\Models\MetaInterface;
use Deep\Seo\Exim\MetaExport;
use Livewire\WithFileUploads;

use Livewire\WithPagination;

class AdminMeta extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $url, $title, $description, $data_id, $media_id, $pendingMeta = [];
    public $isOpenExcel = 0, $excelFile, $isOpen = 0, $perPage = 100, $search;

    public $images = [];

    public function mount(){
        $data =   Meta::select('url')->pluck('url')->toArray();        
        $static = [ "/contact", "/thank-you", "/about-us", "/sitemap", "/blog" ];
        $blogs =   Blog::select('url')->pluck('url')->toArray();
        $blogMeta =   Blogmeta::select('url')->pluck('url')->toArray();
        $total = array_merge($static,  $blogs, $blogMeta);
        $this->pendingMeta = array_diff( $total, $data );
    }

    public function render(){
        $data =   Meta::orderBy( 'id', 'desc')->search($this->search)->paginate($this->perPage);
        return view('deep::livewire.seo.admin-meta', [ 'data' => $data ])->layout('layouts.admin');
    }

    public function submit(){
        $this->validate([
            'url'                       => 'required',
            'title'                     => 'required',
            'description'               => 'required',
        ]);

        $url = sanitizeURL($this->url);

        if( !$this->data_id && Meta::where('url', $url)->exists() ){
            $this->dispatch('alert', ['type' => 'error',  'message' => 'Duplicate Entry, please check' ]);
            return;
        }
        
        addOrUpdateMeta( $url, $this->title, $this->description, $this->data_id, $this->media_id );
        $this->dispatch('alert', ['type' => 'success',  'message' => $this->data_id ? 'Meta Updated Successfully.' : 'Meta Created Successfully.' ]);
        $this->closeModal();
    }

    public function edit( $id ){
        $check  = Meta::where( 'id', decode( $id ) )->first();
        if( !$check ){ return; }
        
        $this->data_id                  =   $check->id;
        $this->url                      =   $check->url;
        $this->title                    =   $check->title;
        $this->description              =   $check->description;
        $this->media_id                 =   $check->media_id;
        $this->isOpen                   =   true;
    }

    public function fileExport(){ return Excel::download(new MetaExport, 'meta.xlsx'); }

    public function uploadExcel(){ $this->isOpenExcel = true; }

    public function submitExcel(){
        $data = $this->validate([
            'excelFile' => 'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,csv',
        ]);
        
        DB::transaction(function () {
            $this->batch_no = getNextUniqueNumber('meta');
            Excel::import(new MetaImport($this->batch_no), $this->excelFile);

            $rows = MetaInterface::where(['batch_no' => $this->batch_no, 'status' => 'New'])->get();
            
            foreach ($rows as $row) {
                $error_count = 0;
                $message = '';
    
                // Check for blank columns
                if( !$row->url ){ $error_count++; $message .= 'URL Missing<br/>'; }
                if( !$row->title ){ $error_count++; $message .= 'Title Missing<br/>'; }
                if( !$row->description ){ $error_count++; $message .= 'Description Missing<br/>'; }
    
                /*** Get Data Entry to update */
                $data = null;
                if( $row->url ){
                    $data = Meta::where( 'url', $row->url )->first();
                    if( !$data ){
                        $error_count++; $message .= 'URL does not exists<br/>';
                    }
                }
    
                if ( !$error_count ) {
                    try{
                        Meta::where('id', $data->id)->update([
                            'url'               =>  $row->url,
                            'title'             =>  $row->title,
                            'description'       =>  $row->description,
                            'media_id'          =>  null,
                        ]);
    
                        $row->status = 'Success';
                        $row->message = "Entry created successfully";
                        $row->update();
                    } catch (\Exception $e) { \Log::warning($e->getMessage()); }

                } else {
                    $row->status = 'Failed';
                    $row->message = $message;
                    $row->update();
                }
            }
    
            return redirect()->route('uploadMeta', [ 'batch' => $this->batch_no ]);
            $this->resetInputFields();
        }, 3);
    }

    public function openModal(){ $this->resetInputFields(); $this->isOpen = true; }
    public function closeModal(){ $this->resetInputFields(); }
    private function resetInputFields(){
        $this->url                      =   null;
        $this->title                    =   null;
        $this->description              =   null;
        $this->excelFile                =   null;
        $this->data_id                  =   null;
        $this->media_id                 =   null;
        $this->isOpen                   =   false;
        $this->isOpenExcel              =   false;
    }
    
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}