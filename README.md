Quality Checker Tool
====================

Simple utility for check your code style

Install
-------

Check following lines to composer.json (repository section):

    "repositories": [
        {
            "type": "git",
            "url": "http://github.com/4xxi/quality-checker.git"
        }
    ],
    "config": {
      "bin-dir": "bin"
    }

Configure pre-install, pre-update hook at composer.json

    "scripts": {
        "post-install-cmd": [
            "QC\\Composer\\Script\\ScriptHandler::install"
        ],
        "post-update-cmd": [
            "QC\\Composer\\Script\\ScriptHandler::install"
        ]
    }
    
Also you can place hook manually

    $ cp vendor/4xxi/quality-checker/src/Hook/pre-commit.php .git/hooks

That's it! Install tool and try to commit:

    $ composer require --dev 4xxi/quality-checker:dev-master

Use cases
----------

* As self-installing git pre-commit hook
* Command line tool
    
Configuration
-------------

The basic architectural principle is working with _suites_. 

You should use default suites provided by library or configure your own. For more information take a look at Example section.

The suites configuration is carried out through a file `quality.yml`

Default configuration:

```
suites:
    pre-commit:
        phpmd:
            type: 'phpmd'
            enabled: true
            options: ~
        phpcs_symfony:
            type: 'phpcs'
            enabled: true
            options:
                standard: 'vendor/escapestudios/symfony2-coding-standard/Symfony2'
        phplint:
            type: 'custom'
            enabled: true
            options:
                cmd: 'php -l {path}'
    fix:
        phpcs_fixer:
            type: 'phpcs-fixer'
            enabled: true
            options:
                rules: '@Symfony'
```

Examples
--------

Run quality check of `src/` dir with default suite and autofix feature 

    $ bin/quality-checker check src/ --autofix

Run quality check of all staged files with custom suite:

    $ bin/quality-checker check --suite=my_own_suite



