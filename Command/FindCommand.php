<?php

namespace Axamit\FileSearchBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Axamit\FileSearchBundle\Adapter\FileSearchAdapterInterface;

class FindCommand extends ContainerAwareCommand
{
    /**
     * @var
     */
    private $adapter;

    /**
     * @param FileSearchAdapterInterface $adapter
     */
    public function __construct(FileSearchAdapterInterface $adapter)
    {
        $this->adapter = $adapter;

        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('axamit_search:find')
            ->setDescription('Find files by content in specific directory')
            ->addArgument(
                'query',
                InputArgument::REQUIRED,
                'Text string to find'
            )
            ->addOption(
                'path',
                null,
                InputOption::VALUE_OPTIONAL,
                'If set, will search in specific directory. Search in current directory by default.'
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getOption('path');
        if (empty($path) || !file_exists($path)) {
            $path = '.'.DIRECTORY_SEPARATOR;
        }

        $query = $input->getArgument('query');

        $result = $this->adapter->search($query, $path);
        foreach ($result as $file) {
            $output->writeln($file);
        }
    }
}
