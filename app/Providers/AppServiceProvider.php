<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\user_certificate;
use  Carbon\Carbon;
use Auth;

use Illuminate\Support\Facades\View;
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
    
        $id =  Auth::id();
    
        $mytime = Carbon::today()->format('y-m-d');

        $license_count =user_certificate::where('user_id',$id)->count();
        
            View::share('license_count', $license_count);
    }
}
