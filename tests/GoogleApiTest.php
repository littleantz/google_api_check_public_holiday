<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class GoogleApiTest extends TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost:8000';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
	 
	 public function setUp() {
        parent::setUp();
		$this->app->instance('middleware.disable', true);
    }
	
    public function testCallGoogleApi()
    {
		
		//command : phpunit --filter testCallGoogleApi
		$response = $this->post('checkPublicHoliday', ['check_date' => '2018-01-01']);
		/*debug the response*/
		dd($response);
		/* requirement :
			composer require --dev phpunit/phpunit ^6.4 => my composer failed to update the phpunit
			https://github.com/laravel/browser-kit-testing
		
		$response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
		*/
    }
}
