<?php

namespace App\Providers;

use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Repositories\Team\TeamRepository;
use App\Repositories\Team\TeamRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            TeamRepositoryInterface::class,
            TeamRepository::class
        );

        $this->app->singleton(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Http\Request $request)
    {
        if (!empty( env('NGROK_URL') ) && $request->server->has('HTTP_X_ORIGINAL_HOST')) {
            $this->app['url']->forceRootUrl(env('NGROK_URL'));
        }
        Paginator::useBootstrap();
        Validator::extend('file_extension', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof UploadedFile) {
                return false;
            }

            $extensions = implode(',', $parameters);
            $validator->addReplacer('file_extension', function (
                $message,
                $attribute,
                $rule,
                $parameters
            ) use ($extensions) {
                return \str_replace(':values', $extensions, $message);
            });

            $extension = strtolower($value->getClientOriginalExtension());

            return $extension !== '' && in_array($extension, $parameters);
        });
    }
}
