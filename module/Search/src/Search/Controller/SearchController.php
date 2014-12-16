<?php
namespace Search\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\File;
use Search\Form;
use Search\Model\ListingsTable;

class SearchController extends AbstractActionController
{
	protected $listingsTable;
	protected $searchForm;	
	protected $searchFormFilter;	
	protected $categories;
	
	public function indexAction()
    {
    	// messages
    	if ($this->flashMessenger()->hasMessages()) {
    		$messages = $this->flashMessenger()->getMessages();
    	} else {
    		$messages = array();
    	}
    	
    	// categories are defined in Application/config/module.config.php as a service
    	$categoryAssocList = $this->makeAssoc();

    	// set up form
    	$this->searchForm->prepareElements($categoryAssocList);

        return new ViewModel(array(	'categories' => $this->categories, 
        							'searchForm' => $this->searchForm, 
        							'messages' 	 => $messages,));
    }

    public function listAction()
    {
		$goHome = TRUE;
		    	
    	// pull data from $_POST
   		$data = $this->params()->fromPost();

    	// check to see if submit button pressed
    	if (isset($data['submit'])) {

    		// prepare filters
    		$this->searchFormFilter->prepareFilters($this->categories);
    		$this->searchFormFilter->setData($data);

	    	// validate data against the filter
    		if ($this->searchFormFilter->isValid($data)) {
    			
    			// retrieve filtered and validated data from filter
    			$validData = $this->searchFormFilter->getValues();

				// save searching to database and deal with results
				$results = $this->listingsTable->search($validData); 
				if ($results) {
					$goHome = FALSE;
				} else {
					// add flash message
					$this->flashMessenger()->addMessage('No results for this search!');
				}				
    		} 
    	}
		if ($goHome) {
			return $this->redirect()->toRoute('search-home');
		} else { 	
    		return new ViewModel(array('categories' => $this->categories, 
    								   'shortList' => $results));
		}
    }
    
    /**
     * Converts numeric array of categories into an associative array
     * 
     * @return Array $categoryAssocList = associative array of categories where key = value
     */
    protected function makeAssoc()
    {
    	$categoryAssocList = array('1' => '-- Choose --');
    	foreach ($this->categories as $item) {
    		$categoryAssocList[$item] = $item;
    	}
    	return $categoryAssocList;
    }
    
    // called by SearchControllerFactory
    public function setListingsTable(ListingsTable $table)
    {
    	$this->listingsTable = $table;
    }
    
    // called by SearchControllerFactory
    public function setSearchForm(Form\SearchForm $form)
    {
    	$this->searchForm = $form;
    }
    
    // called by SearchControllerFactory
    public function setSearchFormFilter(Form\SearchFormFilter $filter)
    {
    	$this->searchFormFilter = $filter;
    }

    // called by SearchControllerFactory
    public function setCategories($categories)
    {
    	$this->categories = $categories;
    }
}
