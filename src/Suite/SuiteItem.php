<?php

namespace QC\Suite;

/**
 * Class SuiteItem.
 */
class SuiteItem
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @var array
     */
    private $options;

    /**
     * ChainItem constructor.
     *
     * @param string $type
     * @param bool   $enabled
     * @param array  $options
     */
    public function __construct($type, $enabled, array $options = [])
    {
        $this->type = $type;
        $this->enabled = $enabled;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
