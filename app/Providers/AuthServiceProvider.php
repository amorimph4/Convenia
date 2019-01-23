<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Group;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // @can faço a validação no front e aqui depois ver no blade essa parada de can
        // bom por em quanto fico assim cada route vou ter que passar o id pro controller lá e no denies passar o id e ai vai fazer as parada que eu preciso
        Gate::define('route-permission', function($user , $route){

            // $group =  Group::findOrFail($user->group_id);
            // $routes = json_decode($group->roles);
            // return in_array($route, $routes);  

        });
    }
}
