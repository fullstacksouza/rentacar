<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust;

class MenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['can']) && (!\Auth::user()->hasRole($item['can']))) {
            return false;
        }

        return $item;
    }
}
