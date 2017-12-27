<?php

namespace App\Http\ViewComposers;

use App\Contracts\UserInterface;
use Illuminate\View\View;

class ShoppingCartComposer
{
    /**
     * The user interface implementation.
     *
     * @var UserInterface
     */
    protected $users;

    /**
     * Create a new shopping cart composer.
     *
     * @param  UserInterface $users
     * @return void
     */
    public function __construct(UserInterface $users)
    {
        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (auth()->check()) {
            $view->with('shoppingCart', $this->users->shoppingCart());
        }
    }
}
