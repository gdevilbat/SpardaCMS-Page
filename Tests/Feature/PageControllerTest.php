<?php

namespace Gdevilbat\SpardaCMS\Modules\Page\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase, \Gdevilbat\SpardaCMS\Modules\Core\Tests\ManualRegisterProvider;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testReadPage()
    {
        $response = $this->get(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'));

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); // Return Not Valid, User Not Login

        $user = \App\User::find(1);

        $response = $this->actingAs($user)
                         ->from(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'))
                         ->json('GET',action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@serviceMaster'))
                         ->assertSuccessful()
                         ->assertJsonStructure(['data', 'draw', 'recordsTotal', 'recordsFiltered']); // Return Valid user Login
    }

    public function testCreateDataPage()
    {
        $response = $this->post(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@store'));

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); //Return Not Valid, User Not Login

        $user = \App\User::find(1);

        $response = $this->actingAs($user)
                         ->from(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@create'))
                         ->post(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@store'))
                         ->assertStatus(302)
                         ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@create'))
                         ->assertSessionHasErrors(); //Return Not Valid, Data Not Complete

        $faker = \Faker\Factory::create();
        $name = $faker->word;
        $slug = $faker->word;

        $response = $this->actingAs($user)
                         ->from(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@create'))
                         ->post(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@store'), [
                                'post' => ['post_title' => $name, 'post_slug' => $slug, 'post_content' => $faker->text],
                            ])
                         ->assertStatus(302)
                         ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'))
                         ->assertSessionHas('global_message.status', 200)
                         ->assertSessionHasNoErrors(); //Return Valid, Data Complete

        $this->assertDatabaseHas(\Gdevilbat\SpardaCMS\Modules\Post\Entities\Post::getTableName(), ['post_slug' => $slug]);
    }

    public function testUpdateDataPage()
    {
        $response = $this->post(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@store'), [
                        '_method' => 'PUT'
                    ]);

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); //Return Not Valid, User Not Login


        $user = \Gdevilbat\SpardaCMS\Modules\Core\Entities\User::with('role')->find(1);

        $page = \Gdevilbat\SpardaCMS\Modules\Post\Entities\Post::where('post_type', 'page')->first();

        $response = $this->actingAs($user)
                        ->from(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@create').'?code='.encrypt($page->getKey()))
                        ->post(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@store'), [
                            'post' => ['post_title' => $page->post_title, 'post_slug' => $page->post_slug, 'post_content' => $page->post_content],
                            $page->getKeyName() => encrypt($page->getKey()),
                            '_method' => 'PUT'
                        ])
                        ->assertStatus(302)
                        ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'))
                        ->assertSessionHas('global_message.status', 200)
                        ->assertSessionHasNoErrors(); //Return Valid, Data Complete
    }

    public function testDeleteDataPage()
    {
        $response = $this->post(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@destroy'), [
                        '_method' => 'DELETE'
                    ]);

        $response->assertStatus(302)
                 ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth\LoginController@showLoginForm')); //Return Not Valid, User Not Login


        $user = \App\User::find(1);

        $page = \Gdevilbat\SpardaCMS\Modules\Post\Entities\Post::where('post_type', 'page')->first();

        $response = $this->actingAs($user)
                        ->from(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'))
                        ->post(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@destroy'), [
                            $page->getKeyName() => encrypt($page->getKey()),
                            '_method' => 'DELETE'
                        ])
                        ->assertStatus(302)
                        ->assertRedirect(action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index'))
                        ->assertSessionHas('global_message.status', 200);

        $this->assertDatabaseMissing(\Gdevilbat\SpardaCMS\Modules\Post\Entities\Post::getTableName(), [$page->getKeyName() => $page->getKey()]);
    }
}
