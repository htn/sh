<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

class ProfileComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */ 
    protected $menu;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct() {
        // Dependencies automatically resolved by service container...       
        $this->menu = [
            'Menu One',
            'Menu Two',
            'Menu Three',
            'Menu Four',
            'Menu Five'
        ];
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {      
        $view->with('mainsidebarmenu', $this->menu);
    }

}
