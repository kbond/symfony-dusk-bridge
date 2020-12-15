<?php

namespace Symfony\Bridge\Dusk\Tests;

use Laravel\Dusk\Browser;
use Symfony\Bridge\Dusk\Test\Dusk;
use Symfony\Component\Panther\PantherTestCase;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class DuskTest extends PantherTestCase
{
    use Dusk;

    /**
     * @test
     */
    public function basic_dusk_usage(): void
    {
        $this->browse(function(Browser $browser) {
            $browser
                ->visit('/page1')
                ->assertSeeIn('h1', 'h1 title')
            ;
        });
    }

    /**
     * @test
     */
    public function multiple_dusk_browsers(): void
    {
        $this->browse(function(Browser $browser1, Browser $browser2) {
            $browser1
                ->visit('/page1')
                ->assertPathIs('/page1')
            ;

            $browser2
                ->visit('/page2')
                ->assertPathIs('/page2')
            ;

            // this ensures a different browser is actually used
            $browser1->assertPathIs('/page1');
        });
    }
}
