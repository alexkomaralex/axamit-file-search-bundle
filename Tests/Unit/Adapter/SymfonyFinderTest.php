<?php

namespace Axamit\FileSearchBundle\Tests\Unit;

use Axamit\FileSearchBundle\Adapter\SymfonyFinder;

class SymfonyFinderTest extends PhpIteratorTest
{
    protected function getAdapter() {
        return new SymfonyFinder();
    }
}
