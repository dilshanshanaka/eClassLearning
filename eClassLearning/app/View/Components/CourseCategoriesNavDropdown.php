<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CourseCategoriesNavDropdown extends Component
{
    
    public $mainCategories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($mainCategories)
    { 
        $this->mainCategories = $mainCategories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.course-categories-nav-dropdown');
    }
}
