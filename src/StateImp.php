<?php

namespace WS\StateSeeder;

use Closure;
use Exception;
use Illuminate\Support\Collection;

class StateImp implements State
{

    /**
     * @var StringTable
     */
    private $layerTable;

    public function __construct()
    {
        $this->layerTable = new LayerTable();
    }

    /**
     * @param Collection $collection
     * @param string $type
     * @return Closure
     */
    private static function fFillCollectionDataBy(&$collection, string $type)
    {
        return function (StateLayer $layer) use (&$collection, $type) {
            $filtered = $layer
                ->getDataStream()
                ->getData()
                ->filter(self::fInstanceofClass($type));
            $collection = $collection->merge($filtered);
        };
    }

    /**
     * @param string $class
     * @return Closure
     */
    private static function fInstanceofClass(string $class): Closure
    {
        return function ($instance) use ($class) {
            return $instance instanceof $class;
        };
    }

    public function generate(string $type, int $count = null, string $state = null): DataStream
    {
        if (!class_exists($type)) throw new Exception("Class:{$type} not found");

        $factory = $state ? factory($type, $count)->state($state) : factory($type, $count);
        $stream = new DataStreamImp($factory->make());
        $layer = new StateLayerImp($stream);
        $this->layerTable->add($layer);

        return $stream;
    }

    public function coverWithLayer(string $layerClass): State
    {
        if (!class_exists($layerClass)) throw new Exception("Class:{$layerClass} not found");
        $layer = new $layerClass();
        $this->layerTable->add($layer);

        return $this;
    }

    public function getLayerStream(string $layerClass)
    {
        if (!class_exists($layerClass)) throw new Exception("Class:{$layerClass} not found");
        $layer = $this->layerTable->getTopBy($layerClass);
        if (!$layer) return null;

        return $layer->getDataStream();
    }

    /**
     * @return DataStream|null
     */
    public function topLayerStream()
    {
        $layer = $this->layerTable->top();
        if (!$layer) return null;

        return $layer->getDataStream();
    }

    public function getTypeStream(string $type): DataStream
    {
        if (!class_exists($type)) throw new Exception("Class:{$type} not found");

        $collection = collect();
        $this->layerTable->all()->each(self::fFillCollectionDataBy($collection, $type));

        return new DataStreamImp($collection);
    }

    public function persist()
    {
        // TODO: Implement persist() method.
    }

    public function clear(): State
    {
        // TODO: Implement clear() method.
    }
}
