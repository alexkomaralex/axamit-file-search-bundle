<?php
namespace Alexkomaralex\FileSearchBundle\Tests\Command;

use Alexkomaralex\FileSearchBundle\Command\FindCommand;
use Alexkomaralex\FileSearchBundle\Adapter\SymfonyFinder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Alexkomaralex\FileSearchBundle\Tests\Command\FindCommandPhpIteratorTest;

class FindCommandSymfonyFinderTest extends FindCommandPhpIteratorTest
{
    protected function getCommand() {
        $kernel = WebTestCase::createKernel();
        $application = new Application($kernel);
        $adapter = new SymfonyFinder();
        $application->add(new FindCommand($adapter));

        return $application->find('fsearch:find');
    }

}
