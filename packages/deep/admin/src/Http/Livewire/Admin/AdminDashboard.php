<?php

namespace Deep\Admin\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\User;
use Deep\Blogs\Models\Blog;
use Deep\Pages\Models\Contact;
use Deep\Blogs\Models\Comments;

class AdminDashboard extends Component
{
    
    public $perPage = 100;
    public $search;

    public $totalUsers, $verifiedUsers, $unverifiedUsers;

    public $totalContact;

    public function mount(){
        $this->getData();
    }

    public function render(){
        return view('deep::livewire.admin.admin-dashboard')->layout('layouts.admin');
    }

    private function getData(){
        $this->totalUsers = User::count();
        $this->verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $this->unverifiedUsers = User::whereNull('email_verified_at')->count();
        $this->totalBlog = Blog::count();
        $this->totalContact = Contact::count();
        $this->totalComments = Comments::active()->count();
    }
    
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}
