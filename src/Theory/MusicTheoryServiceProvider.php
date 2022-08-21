<?php

namespace RyanThompson\MusicTheory;

use Illuminate\Support\ServiceProvider;

class StreamsServiceProvider extends ServiceProvider
{

    public array $aliases = [
        'Theory' => \RyanThompson\MusicTheory\Theory::class,
    ];

    public array $singletons = [
        'theory' => \RyanThompson\MusicTheory\Theory::class,
    ];

    public array $bindings = [];

    public function register(): void
    {
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
