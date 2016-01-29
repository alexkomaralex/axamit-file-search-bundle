<?php
namespace Axamit\FileSearchBundle\Tests\Command;

use Axamit\FileSearchBundle\Command\FindCommand;
use Axamit\FileSearchBundle\Adapter\SymfonyFinder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Axamit\FileSearchBundle\Tests\Command\FindCommandPhpIteratorTest;

class FindCommandSymfonyFinderTest extends FindCommandPhpIteratorTest
{
    protected function getCommand() {
        $kernel = WebTestCase::createKernel();
        $application = new Application($kernel);
        $adapter = new SymfonyFinder();
        $application->add(new FindCommand($adapter));

        return $application->find('axamit_search:find');
    }

}
