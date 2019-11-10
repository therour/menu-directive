<?php

namespace Therour\MenuDirective;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MenuDirectiveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php',
            'menu-directive'
        );

        $this->app->singleton(MenuBuilder::class, function ($app) {
            $builder = $app->make($app['config']->get('menu-directive.builder'));
            return $builder;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('menu-directive.php'),
        ], 'config');

        Blade::directive('sidebarDivider', function ($expression) {
            return '<?php echo app(\Therour\MenuDirective\MenuBuilder::class)->renderDivider() ?>';
        });
        Blade::directive('sidebarHeading', function ($expression) {
            return '<?php echo app(\Therour\MenuDirective\MenuBuilder::class)->renderHeading('.$expression.') ?>';
        });
        Blade::directive('sidebarMenu', function ($expression) {
            return '<?php echo app(\Therour\MenuDirective\MenuBuilder::class)->renderMenu(
    app(\Therour\MenuDirective\MenuBuilder::class)->makeMenu('.$expression.')
) ?>';
        });
        Blade::directive('sidebarDropdown', function ($expression) {
            return '<?php echo app(\Therour\MenuDirective\MenuBuilder::class)->renderDropdown(
    app(\Therour\MenuDirective\MenuBuilder::class)->makeDropdown('.$expression.')
) ?>';
        });
    }
}
