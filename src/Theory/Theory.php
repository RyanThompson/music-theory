<?php

namespace RyanThompson\MusicTheory\Theory;

use Illuminate\Support\Arr;
use Streams\Core\Support\Traits\Prototype;

class Theory
{
    use Prototype {
        Prototype::__construct as constructPrototype;
    }

    public string $key = 'C';

    public array $notes = ['A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#'];

    public array $intervals = [
        0 => [
            'name' => 'Perfect Unison',
            'alt' => [
                'name' => 'Diminished Second',
            ],
        ],
        1 => [
            'name' => 'Minor Second',
            'alt' => [
                'name' => 'Augmented Unison',
            ],
        ],
        2 => [
            'name' => 'Major Second',
            'alt' => [
                'name' => 'Diminished Third',
            ],
        ],
        3 => [
            'name' => 'Minor Third',
            'alt' => [
                'name' => 'Augmented Second',
            ],
        ],
        4 => [
            'name' => 'Major Third',
            'alt' => [
                'name' => 'Diminished Fourth',
            ],
        ],
        5 => [
            'name' => 'Perfect Fourth',
            'alt' => [
                'name' => 'Augmented Third',
            ],
        ],
        6 => [
            'name' => 'Diminished Fifth',
            'alt' => [
                'name' => 'Augmented Fourth',
            ],
        ],
        7 => [
            'name' => 'Perfect Fifth',
            'alt' => [
                'name' => 'Diminished Sixth',
            ],
        ],
        8 => [
            'name' => 'Minor Sixth',
            'alt' => [
                'name' => 'Augmented Fifth',
            ],
        ],
        9 => [
            'name' => 'Major Sixth',
            'alt' => [
                'name' => 'Diminished Seventh',
            ],
        ],
        10 => [
            'name' => 'Minor Seventh',
            'alt' => [
                'name' => 'Augmented Sixth',
            ],
        ],
        11 => [
            'name' => 'Major Seventh',
            'alt' => [
                'name' => 'Diminished Octave',
            ],
        ],
        12 => [
            'name' => 'Perfect Octave',
            'alt' => [
                'name' => 'Augmented Seventh',
            ],
        ],
    ];

    public array $scales = [
        [
            'names' => ['ionian', 'major'],
            'steps' => [2, 2, 1, 2, 2, 2, 1],
        ],
        [
            'names' => ['dorian'],
            'steps' => [2, 1, 2, 2, 2, 1, 2],
        ],
        [
            'names' => ['phrigian'],
            'steps' => [1, 2, 2, 2, 1, 2, 2],
        ],
        [
            'names' => ['lydian'],
            'steps' => [2, 2, 2, 1, 2, 2, 1],
        ],
        [
            'names' => ['mixolydian'],
            'steps' => [2, 2, 1, 2, 2, 1, 2],
        ],
        [
            'names' => ['aeolian', 'minor'],
            'steps' => [2, 1, 2, 2, 1, 2, 2],
        ],
        [
            'names' => ['locrian'],
            'steps' => [1, 2, 2, 1, 2, 2, 2],
        ],
        [
            'names' => ['major_pentatonic'],
            'steps' => [2, 2, 3, 2],
        ],
        [
            'names' => ['minor_pentatonic'],
            'steps' => [3, 2, 2, 3],
        ],
        [
            'names' => ['major_blues'],
            'steps' => [2, 1, 1, 3, 2],
        ],
        [
            'names' => ['minor_blues'],
            'steps' => [3, 2, 1, 1, 3],
        ],
    ];

    public array $chords = [
        [
            'names' => ['major', 'major_triad'],
            'name' => 'Major Triad',
            'components' => [0, 4, 7],
        ],
        [
            'names' => ['major_sixth'],
            'name' => 'Major Sixth',
            'components' => [0, 4, 7, 9],
        ],
        [
            'names' => ['dominant_seventh'],
            'name' => 'Dominant Seventh',
            'components' => [0, 4, 7, 10],
        ],
        [
            'names' => ['major_seventh'],
            'name' => 'Major Seventh',
            'components' => [0, 4, 7, 11],
        ],
        [
            'names' => ['augmented_triad'],
            'name' => 'Augmented Triad',
            'components' => [0, 4, 8],
        ],
        [
            'names' => ['augmented_seventh'],
            'name' => 'Augmented Seventh',
            'components' => [0, 4, 8, 10],
        ],
        [
            'names' => ['minor_triad'],
            'name' => 'Minor Triad',
            'components' => [0, 3, 7],
        ],
        [
            'names' => ['minor_sixth'],
            'name' => 'Minor Sixth',
            'components' => [0, 3, 7, 9],
        ],
        [
            'names' => ['minor_seventh'],
            'name' => 'Minor Seventh',
            'components' => [0, 3, 7, 10],
        ],
        [
            'names' => ['minor_major_seventh'],
            'name' => 'Minor-Major Seventh',
            'components' => [0, 3, 7, 11],
        ],
        [
            'names' => ['diminished_triad'],
            'name' => 'Diminished Triad',
            'components' => [0, 3, 6],
        ],
    ];

    public function __construct(string $root = 'C')
    {
        if ($root == 'random') {
            $root = $this->notes[array_rand($this->notes)];
        }
        
        $this->constructPrototype([
            'root' => $root,
        ]);
    }

    public function scales()
    {
        return $this->scales;
    }

    public function scale($name = null)
    {
        if ($name == 'random') {
            $name = $this->scales[array_rand($this->scales)]['names'][0];
        }

        $name = $name ?: 'ionian';

        $notes[] = $note = $this->key;

        $scale = Arr::first($this->scales, function($scale) use ($name) {
            return array_search($name, $scale['names']) > -1;
        });

        if (!$scale) {
            throw new \Exception("Scale [{$name}] not found.");
        }

        foreach ($scale['steps'] as $interval) {
            $notes[] = $note = $this->note($interval, $note);
        }

        return new Scale($notes);
    }

    public function chords()
    {
        return $this->chords;
    }

    public function chord(string $name, string $root = null)
    {
        if ($name == 'random') {
            $name = $this->chords[array_rand($this->chords)]['names'][0];
        }

        $root = $root ?: $this->key;

        $chord = Arr::first($this->chords, function($chord) use ($name) {
            return array_search($name, $chord['names']) > -1;
        });

        if (!$chord) {
            throw new \Exception("Chord [{$name}] not found.");
        }

        $notes = [];

        foreach ($chord['components'] as $interval) {
            $notes[] = $this->note($interval);
        }

        return new Chord($notes);
    }

    public function note(int $interval, string $note = null)
    {
        $note = $note ?: $this->key;

        $position = array_search($note, $this->notes);

        $target = ($position + $interval) % 12;

        return $this->notes[$target];
    }

    public function degree($note)
    {
        return $this->interval($note) + 1;
    }

    public function interval(string $note)
    {
        $degree = array_search($note, $this->scale());

        if ($degree === false) {
            return null;
        }

        return $degree;
    }

    public function next(string $note, int $degree = 1, $scale = null)
    {
        $notes = $this->scale($scale, $this->key);

        $position = array_search($note, $notes);

        $target = ($position + $degree) % 7;

        return $notes[$target];
    }
}
