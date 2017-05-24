<?php

namespace QC\Configuration\Model;

/**
 * Class Config.
 */
class Config
{
    /**
     * @var array|ConfigItem[]
     */
    private $items;

    /**
     * Chain constructor.
     * @param array|ConfigItem[] $items
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
                new ConfigItem($item['type'], $item['enabled'], $item['options'] ? $item['options'] : [])
            );
        }

        return $config;
    }

    /**
     * @param string    $name
     * @param ConfigItem $item
     */
    public function addItem($name, ConfigItem $item)
    {
        $this->items[$name] = $item;
    }

    /**
     * @return array|ConfigItem[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
