<?php

namespace App;

class Example
{
    /**
     * @var array<int,string>
     */
    private $list;

    /**
     * @param array<int,string>
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function getList(): array
    {
        return $this->list;
    }
}
