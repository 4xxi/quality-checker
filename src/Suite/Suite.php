<?php

namespace QC\Suite;

/**
 * Class Suite.
 */
class Suite
{
    /**
     * @var array|SuiteItem[]
     */
    private $items;

    /**
     * Chain constructor.
     *
     * @param array|SuiteItem[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public static function fromArray(array $data = [])
    {
        $config = new self();

        foreach ($data as $alias => $item) {
            $config->addItem(
                $alias,
                new SuiteItem($item['type'], $item['enabled'], $item['options'] ? $item['options'] : [])
            );
        }

        return $config;
    }

    /**
     * @param string    $name
     * @param SuiteItem $item
     */
    public function addItem($name, SuiteItem $item)
    {
        $this->items[$name] = $item;
    }

    /**
     * @return array|SuiteItem[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
