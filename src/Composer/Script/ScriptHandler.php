<?php

namespace QC\Composer\Script;

use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ScriptHandler.
 */
final class ScriptHandler
{
    /**
     * @param Event $event
     */
    public function install(Event $event)
    {
        self::installHooks();
        self::installConfig();
    }

    /**
     * @throws \Exception
     */
    public static function installHooks()
    {
        $hooks = [
            'pre-commit' => __DIR__.'/../../Hook/pre-commit.php',
        ];

        foreach ($hooks as $nameHook => $pathScriptHook) {
            static::installHook($nameHook, $pathScriptHook);
        }
    }

    /**
     * @param string $nameHook
     * @param string $pathHook
     */
    public static function installHook($nameHook, $pathHook)
    {
        $targetDir = '.git/hooks/'.$nameHook;

        $fs = new Filesystem();
        $fs->copy($pathHook, $targetDir, true);
        $fs->chmod($targetDir, 0755);
    }

    /**
     *
     */
    public static function installConfig()
    {
        $pathConfig = __DIR__.'/../../../quality.yml.dist';
        $pathDestination = rtrim(getcwd(), DIRECTORY_SEPARATOR).'/quality.yml';

        $fs = new Filesystem();
        $fs->copy($pathConfig, $pathDestination);
    }
}
