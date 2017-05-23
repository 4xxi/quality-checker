<?php

namespace QC\Configuration\Model;

/**
 * Class Chain.
 */
class Chain
{
    /**
     * @var array|ChainItem[]
     */
    private $items;

    /**
     * Chain constructor.
     * @param array|ChainItem[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param string    $name
     * @param ChainItem $item
     */
    public function addItem($name, ChainItem $item)
    {
        $this->items[$name] = $item;
    }

    /**
     * @return array|ChainItem[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
