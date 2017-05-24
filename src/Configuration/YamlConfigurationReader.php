<?php

namespace QC\Configuration;

use QC\Configuration\Model\Config;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlConfigurationReader.
 */
class YamlConfigurationReader
{
    const CONFIG_FILE = 'quality-checker.yml';

    /**
     * @return Config
     */
    public function read()
    {
        $data = $this->configFileExists() ? $this->getConfigData() : [];

        return Config::fromArray($data);
    }

    /**
     * @return bool
     */
    private function configFileExists()
    {
        return file_exists(self::CONFIG_FILE);
    }

    /**
     * @return array
     */
    private function getConfigData()
    {
        return Yaml::parse(file_get_contents(self::CONFIG_FILE))['quality-checker'];
    }
}
