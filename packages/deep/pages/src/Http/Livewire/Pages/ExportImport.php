<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Pages\Models\Team;
use Deep\Pages\Models\Pages;

class ExportImport extends Component
{    
    public $data;
    public $services = [
        ["img" => "exam.png", "name" => "Exam Preparation", "text" => " Master your exam prep with focused strategies. Develop a study schedule, utilize practice tests, and review key concepts to ensure success."], 
        ["img" => "expert.png", "name" => "Expert Insights", "text" => "Gain valuable insights from our expert tutors. Their experience and knowledge will help clarify complex topics and boost your confidence."], 
        ["img" => "live.png", "name" => "Live Sessions", "text" => "Participate in engaging live sessions. Ask questions, discuss topics, and collaborate with peers to deepen your understanding of the material."], 
        ["img" => "study.png", "name" => "Study Techniques", "text" => "Explore proven study techniques to enhance learning. Use active recall, spaced repetition, and effective note-taking to optimize your study sessions."], 
    ];

    public $industries = [
        ["img" => "glass.png", "name" => "Collaborate and Grow Together", "text" => "Work collaboratively with peers, sharing knowledge and experiences to foster collective growth and academic achievement."],
        ["img" => "ceramic.png", "name" => "Access Global Knowledge Resources", "text" => "Tap into a vast pool of resources from experts worldwide, enhancing your learning with cutting-edge knowledge."],
        ["img" => "paint.png", "name" => "Engage in a Diverse Learning Network", "text" => "Participate in discussions and learning activities with a diverse community, broadening your educational and cultural awareness."],
        ["img" => "pharmaceuticals.png", "name" => "Engage in a Diverse Learning Network", "text" => "Participate in discussions and learning activities with a diverse community, broadening your educational and cultural awareness."],
        ["img" => "paint.png", "name" => "Engage in a Diverse Learning Network", "text" => "Participate in discussions and learning activities with a diverse community, broadening your educational and cultural awareness."],
        ["img" => "pharmaceuticals.png", "name" => "Engage in a Diverse Learning Network", "text" => "Participate in discussions and learning activities with a diverse community, broadening your educational and cultural awareness."],
     ];
    public $shiping = [
        ["num" => "01.", "name" => "Order Placement", "text" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui provident voluptates est adipisci illo sit excepturi ipsum officiis. Fuga, totam."],
        ["num" => "02.", "name" => "Order Placement", "text" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui provident voluptates est adipisci illo sit excepturi ipsum officiis. Fuga, totam."],
        ["num" => "03.", "name" => "Order Placement", "text" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui provident voluptates est adipisci illo sit excepturi ipsum officiis. Fuga, totam."],
     ];

    public $shiping2 = [
        ["num" => "01.", "name" => "Order Placement", "text" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui provident voluptates est adipisci illo sit excepturi ipsum officiis. Fuga, totam."],
        ["num" => "02.", "name" => "Order Placement", "text" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui provident voluptates est adipisci illo sit excepturi ipsum officiis. Fuga, totam."],
        ["num" => "03.", "name" => "Order Placement", "text" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui provident voluptates est adipisci illo sit excepturi ipsum officiis. Fuga, totam."],
     ];

    public function mount(){
        $this->data         =   Team::active()->get();
        $this->data = Pages::select('id', 'url')->where('url', '/')->first();    
    }

    public function render(){ return view('deep::livewire.pages.export-import'); }
}