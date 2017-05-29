<?php

namespace QC\Suite\Repository;

use QC\Suite\Suite;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlRepository.
 */
class YamlRepository implements RepositoryInterface
{
    const CONFIG_FILE = 'quality.yml';

    /**
     * @param string $suite
     *
     * @return Suite|null
     */
    public function find($suite)
    {
        $data = $this->configFileExists() ? $this->getConfigData() : [];

        if (!isset($data[$suite])) {
            return null;
        }

        return Suite::fromArray($data[$suite]);
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
        return Yaml::parse(file_get_contents(self::CONFIG_FILE))['suites'];
    }
}
