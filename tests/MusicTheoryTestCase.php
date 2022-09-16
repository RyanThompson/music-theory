<?php

namespace RyanThompson\MusicTheory\Tests;

use Streams\Testing\TestCase;
use RyanThompson\MusicTheory\MusicTheoryProvider;

abstract class MusicTheoryTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [MusicTheoryProvider::class];
    }
}
