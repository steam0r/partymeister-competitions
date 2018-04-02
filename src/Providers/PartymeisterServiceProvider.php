<?php

namespace Partymeister\Competitions\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Partymeister\Competitions\Console\Commands\PartymeisterCompetitionsLinkEntryFilesCommand;
use Partymeister\Competitions\Console\Commands\PartymeisterCompetitionsPublishReleaseFilesCommand;
use Partymeister\Competitions\Console\Commands\PartymeisterCompetitionsSyncEntriesCommand;
use Partymeister\Competitions\Console\Commands\PartymeisterCompetitionsSyncLiveVotingCommand;

class PartymeisterServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->config();
        $this->routes();
        $this->routeModelBindings();
        $this->translations();
        $this->views();
        $this->navigationItems();
        $this->permissions();
        $this->registerCommands();
        $this->migrations();
        $this->publishResourceAssets();
    }

    public function publishResourceAssets()
    {
        $assets = [
            __DIR__ . '/../../resources/assets/css'       => resource_path('assets/css'),
        ];

        $this->publishes($assets, 'partymeister-competitions-install');
    }

    public function config()
    {

    }

    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PartymeisterCompetitionsLinkEntryFilesCommand::class,
                PartymeisterCompetitionsSyncEntriesCommand::class,
                PartymeisterCompetitionsSyncLiveVotingCommand::class,
                PartymeisterCompetitionsPublishReleaseFilesCommand::class,
            ]);
        }
    }


    public function migrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }


    public function permissions()
    {
        $config = $this->app['config']->get('motor-backend-permissions', []);
        $this->app['config']->set('motor-backend-permissions',
            array_replace_recursive(require __DIR__ . '/../../config/motor-backend-permissions.php',
                $config));
    }

    public function routes()
    {
        if ( ! $this->app->routesAreCached()) {
            require __DIR__ . '/../../routes/web.php';
            require __DIR__ . '/../../routes/api.php';
        }
    }


    public function translations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'partymeister-competitions');

        $this->publishes([
            __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/partymeister-competitions'),
        ], 'motor-backend-translations');
    }


    public function views()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'partymeister-competitions');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/partymeister-competitions'),
        ], 'motor-backend-views');
    }


    public function routeModelBindings()
    {
        Route::bind('option_group', function($id){
            return \Partymeister\Competitions\Models\OptionGroup::findOrFail($id);
        });

        Route::bind('competition_type', function($id){
            return \Partymeister\Competitions\Models\CompetitionType::findOrFail($id);
        });

        Route::bind('competition', function($id){
            return \Partymeister\Competitions\Models\Competition::findOrFail($id);
        });

        Route::bind('vote_category', function($id){
            return \Partymeister\Competitions\Models\VoteCategory::findOrFail($id);
        });

        Route::bind('entry', function($id){
            return \Partymeister\Competitions\Models\Entry::findOrFail($id);
        });
        Route::bind('access_key', function($id){
            return \Partymeister\Competitions\Models\AccessKey::findOrFail($id);
        });
        Route::bind('competition_prize', function($id){
            return \Partymeister\Competitions\Models\CompetitionPrize::findOrFail($id);
        });
        Route::bind('vote', function($id){
            return \Partymeister\Competitions\Models\Vote::findOrFail($id);
        });
    }


    public function navigationItems()
    {
        $config = $this->app['config']->get('motor-backend-navigation', []);
        $this->app['config']->set('motor-backend-navigation',
            array_replace_recursive(require __DIR__ . '/../../config/motor-backend-navigation.php', $config));
    }
}
