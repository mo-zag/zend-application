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
use Dailymotion;

class DailyMotionSearch implements \Application\SearchVideos\ServiceInterface 
{
    /**
     * Holds daily motion api
     * @var object
     */
	private $dailyMotionAPI;

	public function __construct() {
		$this->dailyMotionAPI = new Dailymotion();
	}

    /**
     * [search description]
     * @param  string  $text  search for text
     * @param  integer $page  page number to return results
     * @param  integer $limit limit number of returned results
     * @return array result from video service
     */
	public function search($text, $page = 1, $limit = 10) 
	{
        $results = array();

        try 
        {
	        $results = $this->dailyMotionAPI->get(
	            '/videos',
	            array(
	                'fields' => array('id', 'title', 'owner', 'channel'),
	                'search' => $text,
	                'page' => $page,
	                'limit' => $limit
	                )
	        );

        } 
        catch (Exception $e) 
        {
        	//log error
        }

        return $results;
        
    }

    /**
     * Find video information via video id
     * @param  int $id video id
     * @return array result from video service
     */
    public function findById($id) {

        $result = array();

        try 
        {
			$result = $this->dailyMotionAPI->get("/video/{$id}");
        } 
        catch (Exception $e) 
        {
        	// log error
        }

        return $result;
    }
}