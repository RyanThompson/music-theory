<?php

namespace RyanThompson\MusicTheory;

use Illuminate\Support\Facades\View;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class MusicTheoryProvider extends ServiceProvider
{

    public array $aliases = [
        'Theory' => \RyanThompson\MusicTheory\Theory\TheoryFacade::class,
    ];

    public array $singletons = [
        'theory' => \RyanThompson\MusicTheory\Theory\Theory::class,
    ];

    public array $bindings = [];

    public function register(): void
    {
        AliasLoader::getInstance($this->aliases)->register();

        View::addNamespace('theory', __DIR__ . '/../resources/views');
        
        // $this->publishes([
        //     dirname(__DIR__) . '/resources/public'
        //     => public_path('vendor/streams/core'),
        // ], ['public']);
    }

    public function boot(): void
    {
        // if ($this->app->runningInConsole()) {
        //     $this->commands([
        //         //
        //     ]);
        // }
    }
}
