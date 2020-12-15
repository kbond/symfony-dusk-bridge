<?php

namespace Symfony\Bridge\Dusk\Test;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use Symfony\Component\Panther\PantherTestCase;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
trait Dusk
{
    use ProvidesBrowser;

    protected function driver()
    {
        if (!$this instanceof PantherTestCase) {
            throw new \RuntimeException(\sprintf('The "%s" trait can only be used on TestCases that extend "%s".', __TRAIT__, PantherTestCase::class));
        }

        if (self::$pantherClient) {
            return self::createAdditionalPantherClient()->getWebDriver();
        }

        self::createPantherClient();

        Browser::$baseUrl = self::$baseUri;

        // todo make the following configurable
        Browser::$storeScreenshotsAt = \sys_get_temp_dir().'/dusk/screenshots';
        Browser::$storeConsoleLogAt = \sys_get_temp_dir().'/dusk/console';
        Browser::$storeSourceAt = \sys_get_temp_dir().'/dusk/source';

        return self::$pantherClient->getWebDriver();
    }
}
