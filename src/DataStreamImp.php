<?php

namespace WS\StateSeeder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DataStreamImp implements DataStream
{

    /**
     * @var Collection
     */
    private $collection;
    /**
     * @var Collection|null
     */
    private $selection;

    /**
     * DataStreamImp constructor.
     *
     * @param Collection|Model $data
     */
    public function __construct($data)
    {
        if (!$data instanceof Collection) {
            $data = collect([$data]);
        }
        $this->collection = $data;
        $this->selection = null;
    }

    public function forOne($modifier): DataStream
    {
        $this->selection = $this->collection->random(1);
        $this->selection->each($modifier);

        return $this;
    }

    public function forAll($modifier = null): DataStream
    {
        $this->selection = $this->collection->collect();
        if ($modifier) {
            $this->selection->each($modifier);
        }

        return $this;
    }

    public function for($filter, $modifier = null): DataStream
    {
        $this->selection = $this->collection->filter($filter);
        if ($modifier) {
            $this->selection->each($modifier);
        }

        return $this;
    }

    public function random($count, $modifier = null): DataStream
    {
        $this->selection = $this->collection->random($count);
        if ($modifier) {
            $this->selection->each($modifier);
        }

        return $this;
    }

    public function first($modifier): DataStream
    {
        $item = $this->selection->first();
        $modifier($item);

        return $this;
    }

    public function last($modifier): DataStream
    {
        $item = $this->selection->last();
        $modifier($item);

        return $this;
    }

    public function then($modifier): DataStream
    {
        $this->selection->each($modifier);

        return $this;
    }

    public function toArray(): array
    {
        $this->collection->toArray();
    }
}
