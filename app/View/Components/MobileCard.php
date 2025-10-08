<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MobileCard extends Component
{
    public $model;
    public $fields;
    public $routePrefix;

    /**
     * Create a new component instance.
     */
    public function __construct($model, $fields = [], $routePrefix = '')
    {
        $this->model = $model;
        $this->fields = $fields;
        $this->routePrefix = $routePrefix;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.mobile-card');
    }
}
