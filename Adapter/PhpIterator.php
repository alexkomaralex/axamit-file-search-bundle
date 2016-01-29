<?php

namespace Axamit\FileSearchBundle\Adapter;

/**
 * Class PhpIterator
 * @package Axamit\FileSearchBundle\Adapter
 */
class PhpIterator implements FileSearchAdapterInterface
{
    public function search($query, $path) {

        $directory = new \RecursiveDirectoryIterator($path);
        $iterator = new \RecursiveIteratorIterator($directory);
        $files = [];
        foreach ($iterator as $info) {
            if (!$info->isDir() && $info->isReadable()) {
                $handle = fopen($info->getPathname(), 'r');
                $valid = false;
                while (($buffer = fgets($handle)) !== false) {
                    if (mb_strpos($buffer, $query) !== false) {
                        $valid = TRUE;
                        break;
                    }
                }
                fclose($handle);

                if ($valid) {
                    $files[] = $info->getPathname();
                }
            }
        }

        return $files;
    }
}
