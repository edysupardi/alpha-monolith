<?php

namespace App\Providers;

use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        JsonResponse::macro('secured', function () {
            $data = json_decode(json_encode(JsonResponse::getData()), $toArray = true);

            array_walk_recursive($data, function(&$value, $key) {
                if ($key === 'ref' || str_contains($key, '_ref')) {
                    $value = !empty($value) ? Helper::encodeBase($value) : $value;
                }
                elseif ($key === 'id' || str_contains($key, '_id')) {
                    $value = !empty($value) ? Crypt::encrypt($value) : $value;
                }
            });

            return $data;
        });
    }
}
