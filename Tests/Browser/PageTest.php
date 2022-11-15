<?php

namespace Gdevilbat\SpardaCMS\Modules\Taxonomy\Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageTest extends DuskTestCase
{
    use DatabaseMigrations, \Gdevilbat\SpardaCMS\Modules\Core\Tests\ManualRegisterProvider;
    
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testCreatePage()
    {
        $user = \App\Models\User::find(1);
        $faker = \Faker\Factory::create();

        $this->browse(function (Browser $browser) use ($user, $faker) {
            $browser->loginAs($user)
                    ->visit(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'))
                    ->assertSee('Master Data of Page')
                    ->clickLink('Add New Page')
                    ->waitForText('Page Form')
                    ->AssertSee('Page Form')
                    ->type('post[post_title]', $faker->word)
                    ->type('post[post_slug]', $faker->word)
                    ->type('meta[meta_title]', $faker->word)
                    ->type('meta[meta_description]', $faker->text);

            $browser->script('document.getElementsByName("post[post_content]")[0].value = "'.$faker->text.'"');
            $browser->script('document.getElementsByName("post[post_status]")[0].checked = true');
            $browser->script('document.getElementsByName("post[comment_status]")[0].checked = true');
            //$browser->script('document.getElementsByName("post[post_parent]")[0].selectedIndex = 1'); Disable For A While
            $browser->script('document.getElementsByName("meta[meta_keyword]")[0].value = "'.$faker->word.'"');
            $browser->script('document.querySelectorAll("[type=submit]")[0].click()');

            $browser->waitForText('Master Data of Page')
                    ->assertSee('Successfully Add Page!');
        });
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testEditPage()
    {
        $user = \App\Models\User::find(1);
        $faker = \Faker\Factory::create();

        $this->browse(function (Browser $browser) use ($user, $faker) {

            $browser->loginAs($user)
                    ->visit(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'))
                    ->assertSee('Master Data of Page')
                    ->waitForText('Actions')
                    ->clickLink('Actions')
                    ->clickLink('Edit')
                    ->AssertSee('Page Form')
                    ->type('post[post_title]', $faker->word)
                    ->type('post[post_slug]', $faker->word)
                    ->type('meta[meta_title]', $faker->word)
                    ->type('meta[meta_description]', $faker->text);

            $browser->script('document.getElementsByName("post[post_content]")[0].value = "'.$faker->text.'"');
            $browser->script('document.getElementsByName("post[post_status]")[0].checked = true');
            $browser->script('document.getElementsByName("post[comment_status]")[0].checked = true');
            //$browser->script('document.getElementsByName("post[post_parent]")[0].selectedIndex = 1'); Disable For A While
            $browser->script('document.getElementsByName("meta[meta_keyword]")[0].value = "'.$faker->word.'"');
            $browser->script('document.querySelectorAll("[type=submit]")[0].click()');

            $browser->waitForText('Master Data of Page')
                    ->assertSee('Successfully Update Page!');
        });
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testDeletePage()
    {
        $user = \App\Models\User::find(1);

        $faker = \Faker\Factory::create();

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                    ->visit(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'))
                    ->assertSee('Master Data of Page')
                    ->waitForText('Actions')
                    ->clickLink('Actions')
                    ->clickLink('Delete')
                    ->waitForText('Delete Confirmation')
                    ->press('Delete')
                    ->waitForText('Master Data of Page')
                    ->assertSee('Successfully Delete Page!');
        });
    }
}
