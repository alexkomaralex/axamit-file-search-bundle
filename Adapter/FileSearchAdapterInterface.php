<?php

namespace Alexkomaralex\FileSearchBundle\Adapter;

interface FileSearchAdapterInterface
{
    public function search($query, $path);
}
