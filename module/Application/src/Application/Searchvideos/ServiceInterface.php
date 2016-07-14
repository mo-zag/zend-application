<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\SearchVideos;

interface ServiceInterface {
    /**
     * Find videos by a search term
     *
     * @param  string  $text Search term
     * @param  integer $page Page to return
     * @return VideoCollection
     */
    public function search($text, $page = 1, $limit = 10);
  
    /**
     * Get video details by its id
     *
     * @param  string $id Video id
     * @return Video
     */
    public function findById($id);

}

