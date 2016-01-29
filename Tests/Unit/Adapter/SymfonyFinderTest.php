<?php

namespace Alexkomaralex\FileSearchBundle\Tests\Unit;

use Alexkomaralex\FileSearchBundle\Adapter\SymfonyFinder;

class SymfonyFinderTest extends PhpIteratorTest
{
    protected function getAdapter() {
        return new SymfonyFinder();
    }
}
