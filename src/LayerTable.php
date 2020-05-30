<?php

namespace WS\StateSeeder;

use Illuminate\Support\Collection;

class LayerTable implements StringTable
{

    /**
     * @var Collection
     */
    private $memoryTable;

    public function __construct()
    {
        $this->memoryTable = new Collection();
    }

    /**
     * @param mixed $item
     */
    public function add($item)
    {
        $this->memoryTable->add($item);
    }

    public function dequeue()
    {
        // TODO ?
    }

    /**
     * @return StateLayer|null
     */
    public function top()
    {
        return $this->memoryTable->last();
    }

    /**
     * @param $key
     * @return StateLayer|null
     */
    public function getTopBy($key)
    {
        return $this->memoryTable->last(self::fInstanceofClass($key));
    }

    /**
     * @param $class
     * @return \Closure
     */
    public static function fInstanceofClass($class) {
        return function ($instance) use ($class) {
            return $instance instanceof $class;
        };
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->memoryTable;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->memoryTable->isEmpty();
    }
}