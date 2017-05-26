Quality Checker Tool
====================

Simple utility for check your code style

Install
-------

Check following lines to composer.json (repository section):

    "repositories": [
        {
            "type": "git",
            "url": "git@bitbucket.org:eglebov/quality-checker.git"
        }
    ],
    "config": {
      "bin-dir": "bin"
    }

Configure pre-install, pre-update hook at composer.json

    "post-install-cmd": [
        // ...
        "QC\\Composer\\Script\\ScriptHandler::installHooks"
    ],
    "post-update-cmd": [
        // ...  
        "QC\\Composer\\Script\\ScriptHandler::installHooks"
    ]
    
Also you can place hook manually

    $ cp vendor/eglebov/quality-checker/src/Hook/pre-commit.php .git/hooks

That's it! Install tool and try to commit:

    $ composer require --dev eglebov/quality-checker
    
Configuration
-------------

The configuration is carried out through a file `quality.yml`

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

Usage
-----

* As pre-commit hook
* Manual run through command line

```
    $ bin/quality-checker quality:check src/ --autofix
```

