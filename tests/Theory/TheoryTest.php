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

    public function test_it_instantiates_with_random_key()
    {
        $theory = new Theory('random');

        $this->assertTrue(in_array($theory->key, $theory->notes));
    }

    public function test_it_returns_scales()
    {
        $theory = new Theory('C');

        $this->assertEquals(['C', 'D', 'E', 'F', 'G', 'A', 'B', 'C'], $theory->scale('major')->all());
    }

    public function test_it_returns_random_scales()
    {
        $theory = new Theory('C');

        $this->assertIsArray($theory->scale('random')->all());
    }

    public function test_it_returns_chords()
    {
        $theory = new Theory('C');

        $this->assertEquals(['C', 'E', 'G'], $theory->chord('major')->all());
    }

    public function test_it_returns_random_chords()
    {
        $theory = new Theory('C');

        $this->assertIsArray($theory->chord('random')->all());
    }
}
