<?php

namespace WS\StateSeeder;

use Illuminate\Support\Collection;

interface StringTable
{

    /**
     * @param mixed $item
     */
    public function add($item);

    /**
     * @return mixed
     */
    public function dequeue();

    /**
     * @return mixed
     */
    public function top();

    /**
     * @param $key
     * @return mixed
     */
    public function getTopBy($key);

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @return bool
     */
    public function isEmpty();
}