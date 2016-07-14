<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Application\SearchVideos\ServiceSearch as ServiceSearch;

class ApplicationControllerTest extends AbstractHttpControllerTestCase
{
	protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include realpath('.').'/config/application.config.php'
        );
        parent::setUp();
    }

	public function testIndexActionCanBeAccessed()
	{
	    $this->dispatch('/search');
	    $this->assertResponseStatusCode(200);
	    $this->assertModuleName('Application');
	    $this->assertControllerName('Application\Controller\Search');
	    $this->assertControllerClass('SearchController');
	    $this->assertMatchedRouteName('search');
	}

	public function testSearchVideo() {

	    $postData = array(
	        'search_video_text'  => 'James'
	    );

	    $this->dispatch('/search', 'POST', $postData);
	    $this->assertResponseStatusCode(200);
	    $this->assertQuery('p', 'James you');
	}

	public function testSingleVideo() {
	    	    
	    $this->dispatch('/search/video/x4hdy4t');
	    $this->assertResponseStatusCode(200);
	    

	}	

	public function testVideoSearcService() {
	    	    
	    $daily = new ServiceSearch();
	    $results = $daily->search('Michele');
	    $this->assertTrue(isset($results['list']));
	    // test config set in application/config/autoload/local.php
	    $this->assertTrue(count($results['list']) > 10);

	}		
}