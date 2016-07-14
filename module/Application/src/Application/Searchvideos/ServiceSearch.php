<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\SearchVideos;

use Application\SearchVideos\ServiceInterface;
use Application\SearchVideos\DailyMotionSearch as DailyMotionSearch;


class ServiceSearch implements \Application\SearchVideos\ServiceInterface 
{

    /**
     * video service api
     * @var object
     */
    public  $providerClass;

    /**
     * Limit the search resulst by
     * @var integer
     */
    public  $resultsLimit = 10;


	public function __construct() {

        /*
         * Get configs from local.php
         */
        $config = \Zend\Config\Factory::fromFile(realpath('.').'/config/autoload/local.php');
		
        /*
         * initiate api service provider class
         */
        $this->getSearchProvider($config['video_search']['search_provider']);
        
        /**
         * Limit the search results from local.php
         */
        if(isset($config['video_search']['search_results_limit']))
        {
            $this->resultsLimit = $config['video_search']['search_results_limit'];
        }
	}

    /**
     * Intiate search api service
     * @param  string $searchProvider Name of video search api service
     */
    private function getSearchProvider($searchProvider) {
        
        if($searchProvider == 'daily_motion') {
            $this->providerClass = new DailyMotionSearch();
        }
    }

    /**
     * Search video service api
     * @param  string  $text  search for text
     * @param  integer $page  page number to return results
     * @param  integer $limit limit number of returned results
     * @return array result from video service
     */
	public function search($text, $page = 1, $limit = 10) 
	{
        if($this->resultsLimit > 0)
        {
          $limit = $this->resultsLimit;  
        } 

        $results = $this->providerClass->search($text, $page, $limit);
        $results['query'] = $text;

        return $results;
        
    }
    
    /**
     * Find video information via video id
     * @param  int $id video id
     * @return array result from video service
     */
    public function findById($id) {

        $result = $this->providerClass->findById($id);

        return $result;
    }
}