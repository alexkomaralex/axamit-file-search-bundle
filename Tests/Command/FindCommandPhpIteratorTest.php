<?php
namespace Alexkomaralex\FileSearchBundle\Tests\Command;

use Alexkomaralex\FileSearchBundle\Command\FindCommand;
use Alexkomaralex\FileSearchBundle\Adapter\SymfonyFinder;
use Alexkomaralex\FileSearchBundle\Adapter\PhpIterator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class FindCommandPhpIteratorTest extends WebTestCase
{
    public function testFoundEn()
    {

        $testDir = __DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.'files';

        $command = $this->getCommand();
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'      => $command->getName(),
            'query'         => 'Vivamus',
            '--path' => $testDir,
        ));

        $result = $commandTester->getDisplay();

        $files = [
            'sub_dir/test_en',
            'test_en'
        ];

        foreach ($files as $file) {
            $this->assertContains($testDir.DIRECTORY_SEPARATOR.$file, $result);
        }

        $this->assertCount(2, array_filter(explode(PHP_EOL, $result)));
    }

    public function testFoundUmlaut()
    {
        $testDir = __DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.'files';

        $command = $this->getCommand();
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'      => $command->getName(),
            'query'         => 'Fülltext',
            '--path' => $testDir,
        ));

        $result = $commandTester->getDisplay();

        $files = [
            'sub_dir/test_de',
            'test_de'
        ];

        foreach ($files as $file) {
            $this->assertContains($testDir.DIRECTORY_SEPARATOR.$file, $result);
        }

        $this->assertCount(2, array_filter(explode(PHP_EOL, $result)));
    }

    public function testNotFount()
    {
        $testDir = __DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.'files';

        $command = $this->getCommand();
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'      => $command->getName(),
            'query'         => 'notfound',
            '--path' => $testDir,
        ));

        $result = $commandTester->getDisplay();

        $this->assertCount(0, array_filter(explode(PHP_EOL, $result)));
    }


    protected function getCommand() {
        $kernel = WebTestCase::createKernel();
        $application = new Application($kernel);
        //$adapter = new SymfonyFinder();
        $adapter = new PhpIterator();
        $application->add(new FindCommand($adapter));

        return $application->find('fsearch:find');
    }

}
