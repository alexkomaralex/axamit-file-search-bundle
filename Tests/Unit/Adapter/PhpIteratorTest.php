<?php
namespace Alexkomaralex\FileSearchBundle\Tests\Unit;

use Alexkomaralex\FileSearchBundle\Adapter\PhpIterator;

class PhpIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function testFoundEn()
    {
        $testDir = __DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.'files';

        $adapter = $this->getAdapter();
        $result = $adapter->search('Vivamus', $testDir);

        $files = [
            $testDir.DIRECTORY_SEPARATOR.'sub_dir/test_en.txt',
            $testDir.DIRECTORY_SEPARATOR.'test_en.txt'
        ];

        $this->assertCount(2, array_intersect($files, $result));

    }

    public function testFoundUmlaut()
    {
        $testDir = __DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.'files';

        $adapter = $this->getAdapter();
        $result = $adapter->search('Fülltext', $testDir);

        $files = [
            $testDir.DIRECTORY_SEPARATOR.'sub_dir/test_de.txt',
            $testDir.DIRECTORY_SEPARATOR.'test_de.txt'
        ];

        $this->assertCount(1, array_intersect([$files[0]], $result));
        $this->assertCount(1, array_intersect([$files[1]], $result));
        $this->assertCount(2, array_intersect($files, $result));
    }

    public function testNotFount()
    {
        $testDir = __DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.'files';

        $adapter = $this->getAdapter();
        $result = $adapter->search('notfound', $testDir);


        $this->assertCount(0, $result);
    }


    protected function getAdapter() {
        return new PhpIterator();
    }

}
