<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Pages\Models\Team;

class About extends Component
{    
    public $data;
    public $services = [
        ["img" => "exam.png", "name" => "Exam Preparation", "text" => " Master your exam prep with focused strategies. Develop a study schedule, utilize practice tests, and review key concepts to ensure success."], 
        ["img" => "expert.png", "name" => "Expert Insights", "text" => "Gain valuable insights from our expert tutors. Their experience and knowledge will help clarify complex topics and boost your confidence."], 
        ["img" => "live.png", "name" => "Live Sessions", "text" => "Participate in engaging live sessions. Ask questions, discuss topics, and collaborate with peers to deepen your understanding of the material."], 
        ["img" => "study.png", "name" => "Study Techniques", "text" => "Explore proven study techniques to enhance learning. Use active recall, spaced repetition, and effective note-taking to optimize your study sessions."], 
    ];

    public $team = [
        ["img" => "instructor.png", "name" => "Priya Sharma", "text" => "Master your exam preparation with effective strategies. Focus on understanding key concepts and practicing with sample papers for success.", "designation" => "Exam Coach"], 
        ["img" => "instructor.png", "name" => "Rajesh Gupta", "text" => "Gain insights from our experienced tutors who simplify complex topics. Let their guidance boost your confidence and understanding.", "designation" => "Subject Matter Expert"], 
        ["img" => "instructor.png", "name" => "Ananya Iyer", "text" => " Join our interactive live sessions to engage directly with instructors. Participate in discussions and get instant feedback on your questions.", "designation" => "Online Learning Facilitator"], 
        ["img" => "instructor.png", "name" => "Arjun Patel", "text" => "Explore proven study strategies that enhance learning. Use techniques like active recall and spaced repetition to improve retention.", "designation" => "Academic Success Advisor"], 
    ];

    public function mount(){
        $this->data         =   Team::active()->get();
    }

    public function render(){ return view('deep::livewire.pages.about'); }
}