<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\SearchVideos\ServiceSearch;
use Zend\ModuleManager\ModuleManager;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;


class SearchController extends AbstractActionController 
{
    /**
     *
     * Search video service
     * 
     * @return view
     */
    
    public function indexAction()
    {
        
        $result = array();
        

        $params = $this->getRequest()->getQuery()->toArray();

        if(isset($params['page']) && $params['search']) 
        {
            
            $searchVideos = new \Application\SearchVideos\ServiceSearch;
            $result = $searchVideos->search($params['search'], $params['page']);
        }

        $postData = $this->getRequest()->getPost()->toArray();
        
        if(!empty($postData) && isset($postData['search_video_text'])) 
        {
            
            $searchVideos = new \Application\SearchVideos\ServiceSearch;
            $result = $searchVideos->search($postData['search_video_text']);
        }

        $viewModelVars = array(
            'searchResult' => $result
        );

        return new ViewModel($viewModelVars);
        
    }

    /**
     * Search for individual video service by id
     * @return View
     */
    
    public function videoAction() {
        
        $result  = array();

        $params = $this->params()->fromRoute();

        if(isset($params['id'])) 
        {
            $searchVideos = new \Application\SearchVideos\ServiceSearch;
            $result = $searchVideos->findById($params['id']);            
        }


        $viewModelVars = array(
            'searchResult' => $result
        );

        return new ViewModel($viewModelVars);        
    }
   
}
