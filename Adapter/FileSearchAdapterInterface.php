<?php

namespace Axamit\FileSearchBundle\Adapter;

interface FileSearchAdapterInterface
{
    public function search($query, $path);
}
