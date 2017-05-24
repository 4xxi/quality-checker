<?php

namespace QC\Configuration;

use QC\Configuration\Model\Chain;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ChainBuilder.
 */
class ChainBuilder
{
    const CONFIG_FILE = 'quality-checker.yml';

    /**
     * @return Chain
     */
    public function build()
    {
        $config = Yaml::parse(file_get_contents(self::CONFIG_FILE));

        var_dump($config); exit;
    }
}
