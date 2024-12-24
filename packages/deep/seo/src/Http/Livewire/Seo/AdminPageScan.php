<?php

namespace Deep\Seo\Http\Livewire\Seo;

use Livewire\Component;

use DB;
use Deep\Blogs\Models\Blog;


// use Illuminate\Http\Client\Response;
// use Symfony\Component\DomCrawler\Crawler;
// use Vormkracht10\Seo\Interfaces\Check;
// use Vormkracht10\Seo\Traits\PerformCheck;

use Livewire\WithPagination;

class AdminPageScan extends Component
{
    use WithPagination;

    // use PerformCheck;

    // public $perPage = 100, $search;


    // /** * The name of the check. */
    // public string $title = "The page has a canonical tag";
    // /** * The priority of the check (in terms of SEO). */
    // public string $priority = 'low';
    // /** * The time it takes to fix the issue. */
    // public int $timeToFix = 1;
    // /** * The weight of the check. This will be used to calculate the score. */
    // public int $scoreWeight = 2;
    // /** * If this check should continue after a failure. You don't * want to continue after a failure if the page is not
    //  * accessible, for example.*/
    // public bool $continueAfterFailure = true; 
    // public string|null $failureReason; 
    // /* If you want to check the actual value later on make sure
    //  * to set the actualValue property. This will be used
    //  * when saving the results.
    //  */
    // public mixed $actualValue = null; 
    // /* If you want to check the expected value later on make sure
    //  * to set the expectedValue property. This will be used
    //  * when saving the results.
    //  */
    // public mixed $expectedValue = null;
    
    
    // public function check(Response $response, Crawler $crawler): bool
    // {
    //     // Feel free to use any validation you want here.
    //     if (! $this->validateContent($crawler)) {
    //         return false;
    //     }
 
    //     return true;
    // }
 
    // public function validateContent(Crawler $crawler): bool
    // {
    //     // Get the canonical tag
    //     $node = $crawler->filterXPath('//link[@rel="canonical"]')->getNode(0);
 
    //     if (! $node) {
    //         // We set the failure reason here so this will be showed in the CLI and saved in the database.
    //         $this->failureReason = 'The canonical tag does not exist';
    //         return false;
    //     }
 
    //     // Get the href attribute
    //     $this->actualValue = $node->getAttribute('href');
 
    //     if (! $this->actualValue) {
    //         // The failure reason is different here because the canonical tag exists, but it does not have a href attribute.
    //         $this->failureReason = 'The canonical tag does not have a href attribute';
 
    //         return false;
    //     }
 
    //     // The canonical tag exists and has a href attribute, so the check is successful.
    //     return true;
    // }

    public function mount(){
        $this->data =   Blog::active()->select('id', 'name', 'url')->get();
    }

    public function render(){
        return view('deep::livewire.seo.admin-page-scan')->layout('layouts.admin');
    }





    
    protected $listeners = [ 'searchUpdated', 'perPageUpdated' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
}