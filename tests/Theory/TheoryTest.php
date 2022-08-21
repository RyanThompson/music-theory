<?php

namespace RyanThompson\MusicTheory\Tests\Theory;

use RyanThompson\MusicTheory\Tests\MusicTheoryTestCase;
use RyanThompson\MusicTheory\Theory\Theory;

class TheoryTest extends MusicTheoryTestCase
{
    public function test_it_instantiates_with_key()
    {
        $theory = new Theory('C');

        $this->assertEquals('C', $theory->key);
    }

    public function test_it_returns_scales()
    {
        $theory = new Theory('C');

        $this->assertEquals(['C', 'D', 'E', 'F', 'G', 'A', 'B', 'C'], $theory->scale('major'));
    }
}
