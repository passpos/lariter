<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                    ->middleware('api')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/api.php'));

            Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting() {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapFrontendRoutes();

        $this->mapBackendRoutes();

        //
    }

    /**
     * Define the "Backend" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapBackendRoutes() {
        Route::middleware('backend')
                ->namespace('App\Backend\Controllers')
                ->group(base_path('routes/backend.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes() {
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
    protected function mapApiRoutes() {
        Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "Frontend" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapFrontendRoutes() {
        Route::middleware('frontend')
                ->namespace('App\Frontend\Controllers')
                ->group(base_path('routes/frontend.php'));
    }

}
