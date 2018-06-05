<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {


        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MINHAS PESQUISAS');
            $event->menu->add([
                'text' => 'Responder',
                'url' => 'user/searches',
                'icon' => 'comments',
                'label' => \Auth::user()->searches()->where('status', 0)->count(),
                'label_color' => 'success',
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
