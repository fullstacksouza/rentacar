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
                'label' => \Auth::user()->searches()->where('search_status', 0)->where('status', 1)->whereDate('date_start', date('y-m-d'))->count(),
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
