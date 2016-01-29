<?php

namespace Alexkomaralex\FileSearchBundle\Adapter;

use Symfony\Component\Finder\Finder;

/**
 * Class SymfonyFinder
 * @package Alexkomaralex\FileSearchBundle\Adapter
 */
class SymfonyFinder implements FileSearchAdapterInterface
{
    public function search($query, $path) {
        $result = [];

        $finder = new Finder();
        $files = $finder->files()->in($path)->contains($query);

        foreach ($files as $file) {
            $result[]=$file->getRealpath();
        }

        return $result;
    }
}
