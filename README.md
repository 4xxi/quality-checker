Quality Checker Tool
====================

Simple git pre-commit hook for checking your code style with:

    PHP Code Sniffer (Symfony2 standard)
    PHP Mess Detector
    PHP Lint

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

That's it! Install tool and try to commit:

    $ composer require --dev eglebov/quality-checker
