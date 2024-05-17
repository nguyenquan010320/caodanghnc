<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; //Import Schema

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); //Solved by increasing StringLength
        // Tú thêm vào 2020-04-18
        Blade::directive('site', function ($expression) {
            return "<?php if(!empty(\$site[{$expression}])): echo str_replace(['<script','</script>'], '', \$site[{$expression}]); endif; ?>";
        });
        Blade::directive('ifturnon', function ($expression) {
            return "<?php if(isset(\$site[{$expression}]) && \$site[{$expression}]=='1'): ?>";
        });
        Blade::directive('ifnotempty', function ($expression) {
            return "<?php if(!empty(\$site[{$expression}])): ?>";
        });
        Blade::directive('money', function ($expression) {
            return "<?php echo Helper::money({$expression},\$lang,\$languages); ?>";
        });
        Blade::directive('date', function ($expression) {
            return "<?php if(!empty({$expression})): echo Helper::date({$expression}); endif; ?>";
        });
        Blade::directive('lang', function ($expression) {
            return "<?php if(!empty({$expression})): echo Helper::lang({$expression},\$lang,\$languages); endif; ?>";
        });
        Blade::directive('langadmin', function ($expression) {
            return "<?php if(!empty({$expression})): echo Helper::langadmin({$expression},\$lang,\$languages); endif; ?>";
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
