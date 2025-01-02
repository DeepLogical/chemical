<?php

namespace App\Livewire\Pages;

use Livewire\Component;

use Deep\Pages\Models\Pages;

class Home extends Component
{
    public $data;
    
    public $about = [
        ["img" => "best-quality.png", "name" => "Best Quality", "text" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam laudantium aspernatur quas provident illo pariatur rerum aut, unde sapiente modi! Libero ratione quia perspiciatis doloribus, velit cupiditate. Facilis, ad laborum."],
        ["img" => "distribution.png", "name" => "Distribution", "text" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam laudantium aspernatur quas provident illo pariatur rerum aut, unde sapiente modi! Libero ratione quia perspiciatis doloribus, velit cupiditate. Facilis, ad laborum."],
        ["img" => "export.png", "name" => "Export / Import", "text" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam laudantium aspernatur quas provident illo pariatur rerum aut, unde sapiente modi! Libero ratione quia perspiciatis doloribus, velit cupiditate. Facilis, ad laborum."],
        ["img" => "demand.png", "name" => "On Demand", "text" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam laudantium aspernatur quas provident illo pariatur rerum aut, unde sapiente modi! Libero ratione quia perspiciatis doloribus, velit cupiditate. Facilis, ad laborum."],
     ];
    public $industries = [
        ["img" => "glass.png", "name" => "Collaborate and Grow Together", "text" => "Work collaboratively with peers, sharing knowledge and experiences to foster collective growth and academic achievement."],
        ["img" => "ceramic.png", "name" => "Access Global Knowledge Resources", "text" => "Tap into a vast pool of resources from experts worldwide, enhancing your learning with cutting-edge knowledge."],
        ["img" => "paint.png", "name" => "Engage in a Diverse Learning Network", "text" => "Participate in discussions and learning activities with a diverse community, broadening your educational and cultural awareness."],
        ["img" => "pharmaceuticals.png", "name" => "Engage in a Diverse Learning Network", "text" => "Participate in discussions and learning activities with a diverse community, broadening your educational and cultural awareness."],
     ];
    public $tenets = [
        ["img" => "container.jpg", "name" => "Marketing and Distributing Chemicals since 1980", "text" => ""],
        ["img" => "container.jpg", "name" => "30+ Active Supply in Glass and Ceramic Industry ", "text" => ""],
        ["img" => "container.jpg", "name" => "Market Leader in most of its product lines", "text" => ""],
        ["img" => "container.jpg", "name" => "Marketing and Distributing Chemicals since 1980", "text" => ""],
        ["img" => "container.jpg", "name" => "30+ Active Supply in Glass and Ceramic Industry ", "text" => ""],
        ["img" => "container.jpg", "name" => "Market Leader in most of its product lines", "text" => ""],
     ];
    public $learning = [
        ["img" => "book.svg", "name" => "Online Courses", "text" => "Online courses provide a flexible way to learn new skills from anywhere. They offer a convenient platform for personal and professional growth, allowing learners to study at their own pace and access expert resources."],
        ["img" => "upgrade.svg", "name" => "Upgrade Skills", "text" => "Enhancing your skillset is crucial for staying ahead in today’s competitive world. Upgrading your abilities opens up new career opportunities and ensures you remain adaptable in the face of changing industry demands."],
        ["img" => "certificate.svg", "name" => "Certifications", "text" => "Certifications validate your expertise and demonstrate your commitment to professional development. They boost your credibility and enhance your qualifications, helping you stand out in a crowded job market."],
     ];

    public $choose = [
        ["img" => "book.svg", "name" => "Why We Are the Preferred Option", "text" => "Our commitment to personalized education and student support makes us the top choice for learners seeking success."],
        ["img" => "upgrade.svg", "name" => "Our Proven Approach to Success", "text" => "We combine innovative teaching with real-world applications, ensuring students acquire knowledge and skills essential for career advancement."],
     ];
    public $chooses = [
        ["img" => "book.svg", "name" => "Tailored Solutions for Every Learner", "text" => "We offer customized learning experiences to meet individual needs, ensuring each student achieves their specific goals effectively."],
        ["img" => "upgrade.svg", "name" => "Achieve Your Goals with Confidence", "text" => "Our supportive resources empower students to pursue and achieve their goals, fostering confidence throughout their educational journey."],
     ];

     public $card = [
        ["img" => "", "name" => "", "text" => ""],
        ["img" => "", "name" => "", "text" => ""],
        ["img" => "", "name" => "", "text" => ""],
        ["img" => "", "name" => "", "text" => ""],
        ["img" => "", "name" => "", "text" => ""],
        ["img" => "", "name" => "", "text" => ""],
     ];

    public function mount(){
        $this->data = Pages::select('id', 'url')->where('url', '/')->first();
    }

    public function render(){ return view('livewire.pages.home'); }
}
