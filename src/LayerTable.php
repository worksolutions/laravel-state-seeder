<?php

namespace WS\StateSeeder;

class LayerTable implements StringTableQueue
{

    /**
     * @var array
     */
    private $memoryTable;

    public function __construct()
    {
        $this->memoryTable = [];
    }

    public function enqueue($item)
    {
        array_push($this->memoryTable, $item);
    }

    public function dequeue()
    {
        return array_unshift($this->memoryTable);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !empty($this->memoryTable);
    }
}