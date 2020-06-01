<?php
/**
 * @author Maxim Sokolovsky
 */

namespace WS\StateSeeder;

use Illuminate\Support\Collection;

interface DataStream
{
    /**
     * @param array|callable $modifier Data of function f(Model $model, State $state) {}
     * @return $this
     */
    public function forOne($modifier): self;

    /**
     * Apply modifier for all elements and reset selection. If modifier is null then only reset selection
     * @param array|callable|null $modifier Data or function f(Model $model, State $state) {}
     * @return $this
     */
    public function forAll($modifier = null): self;

    /**
     * @param array|callable $filter Filter array or function f(Model $model) {}
     * @param null|callable $modifier
     * @return $this
     */
    public function for($filter, $modifier = null): self;

    /**
     * Calls modifier for random elements
     * @param $count "Count random elements or closure if need only ony element
     * @param $modifier "undefined value or callable if random count param is present
     * @return $this
     */
    public function random($count, $modifier = null): self;

    /**
     * Calls modifier for the first element in stream
     * @param array|callable $modifier Data of function f(Model $model, State $state) {}
     * @return $this
     */
    public function first($modifier): self;

    /**
     * Calls modifier for the last element in stream
     * @param array|callable $modifier Data of function f(Model $model, State $state) {}
     * @return $this
     */
    public function last($modifier): self;

    /**
     * Calls modifier for previous selection elements
     * @param $modifier
     * @return $this
     */
    public function then($modifier): self;

    /**
     * Returns array of stream objects
     * @return array
     */
    public function toArray(): array;

    /**
     * @return Collection
     */
    public function getData(): Collection;
}
