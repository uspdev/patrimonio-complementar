<?php

namespace App\Providers;

use App\Models\Patrimonio;
use App\Policies\PatrimonioPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Patrimonio::class => PatrimonioPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();
        Gate::resource('patrimonios', 'App\Policies\PatrimonioPolicy');

        //
    }
}
