<?php


namespace WS\StateSeeder;


interface StringTableQueue
{

    /**
     * @param mixed $item
     */
    public function enqueue($item);

    /**
     * @return mixed
     */
    public function dequeue();

    /**
     * @return bool
     */
    public function isEmpty();
}