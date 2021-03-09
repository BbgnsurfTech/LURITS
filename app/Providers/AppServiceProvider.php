<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Atlas;
use Auth;
use App\User;
use App\AtlasLink;
use App\SchoolAtlas;
use App\School;

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
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                //SUPER ADMIN & ADMIN
                $country_list = Atlas::select('name_atlas_entity', 'code_atlas_entity')
                        ->where('code_ds_atlas_entity', 1)
                        ->groupBy('code_atlas_entity','name_atlas_entity')
                        ->get();
                //ZEQA
                if (Auth::User()->is_zeqa) {
                    $a = Auth::User()->atlas;
                    $stateLGA = AtlasLink::where('code_atlas_link', $a->atlas_id)->pluck('code_atlas_entity');
                    $lga = Atlas::whereIn('code_atlas_entity', $stateLGA)->get();
                } else {
                    $lga = null;
                }
                //LGEA
                if (Auth::User()->is_lgea) {
                    $a = Auth::User()->atlas;
                    $b = $a->atlas_id;
                    $schooll = SchoolAtlas::where('code_atlas_entity', $b)->pluck('school_id');
                    $lgea = School::whereIn('id', $schooll)->where('code_type_sector', 1)->get();
                } else {
                    $lgea = null;
                }

                $view->with('country_list', $country_list)->with('lga', $lga)->with('lgea', $lgea);
                // View::share('zones', $zones);
            } else {
                
            }

        });
    }
}
