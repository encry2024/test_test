<?php

namespace App\Providers;

use App\Models\Auth\User;
use App\Models\Distributor\Distributor;
use App\Models\Inventory\Inventory;
use App\Models\Client\Client;
use App\Models\Transaction\Transaction;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        /*
        * Register route model bindings
        */

        /*
         * This allows us to use the Route Model Binding with SoftDeletes on
         * On a model by model basis
         */
        $this->bind('deletedUser', function ($value) {
            $user = new User;

            return User::withTrashed()->where($user->getRouteKeyName(), $value)->first();
        });

        $this->bind('deletedDistributor', function ($value) {
            $distributor = new Distributor;

            return Distributor::withTrashed()->where($distributor->getRouteKeyName(), $value)->first();
        });

        $this->bind('deletedInventory', function ($value) {
            $inventory = new Inventory;

            return Inventory::withTrashed()->where($inventory->getRouteKeyName(), $value)->first();
        });

        $this->bind('deletedClient', function ($value) {
            $client = new Client;

            return Client::withTrashed()->where($client->getRouteKeyName(), $value)->first();
        });

        $this->bind('transaction', function ($value) {
            return Transaction::with(['client_transactions', 'user'])->where('reference_id', $value)->first();
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
