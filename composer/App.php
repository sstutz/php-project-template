<?php

namespace ComposerScripts;

use Composer\Script\Event;

class App
{
    /**
     * Handle the post-install Composer event.
     *
     * @param  \Composer\Script\Event $event
     *
     * @return void
     * @throws \RuntimeException
     */
    public static function postInstall(Event $event): void
    {
        $hook = 'git/hooks/pre-commit';
        // Register the applications custom pre-commit hook
        if (is_readable($hook) && copy($hook, ".$hook")) {
            chmod(".$hook", 0775);
        }
    }

    /**
     * @param Event $event
     */
    public static function postUpdate(Event $event): void
    {
        static::postInstall($event);
    }
}
