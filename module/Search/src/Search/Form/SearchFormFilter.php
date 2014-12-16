<?php
namespace Search\Form;

use Zend\InputFilter\Input;
use Zend\Validator;
use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Search\Filter\Float;

class SearchFormFilter extends InputFilter
{
	public function prepareFilters(Array $categories)
	{
		$category = new Input('category');
		$category->setAllowEmpty(TRUE);
		$category->getFilterChain()
				 ->attach(new Filter\StringToLower())
				 ->attachByName('StripTags')
				 ->attachByName('StringTrim');
		
		$title = new Input('title');
		$title->setAllowEmpty(TRUE);
		$title->getFilterChain()
			 ->attachByName('StripTags')
			 ->attachByName('StringTrim');

		$priceMin = new Input('priceMin');
		$priceMin->setAllowEmpty(TRUE);
		$priceFilter = new Float();
		$priceMin->getFilterChain()
				 ->attach($priceFilter);
		
		$priceMax = new Input('priceMax');
		$priceMax->setAllowEmpty(TRUE);
		$priceFilter = new Float();
		$priceMax->getFilterChain()
				 ->attach($priceFilter);
		
		$expires = new Input('expires');
		$expires->setAllowEmpty(TRUE);
		$expires->getFilterChain()
			    ->attachByName('StripTags')
				->attachByName('StringTrim');
		
		$city = new Input('city');
		$city->setAllowEmpty(TRUE);
		$city->getFilterChain()
			 ->attachByName('StripTags')
			 ->attachByName('StringTrim');
		
		$country = new Input('country');
		$country->setAllowEmpty(TRUE);
		$country->getFilterChain()
				->attachByName('StringToUpper')
				->attachByName('StripTags')
			 	->attachByName('StringTrim');
		
		$name = new Input('name');
		$name->setAllowEmpty(TRUE);
		$name->getFilterChain()
			  ->attachByName('StripTags')
			  ->attachByName('StringTrim');
  
		$phone = new Input('phone');
		$phone->setAllowEmpty(TRUE);
		$phone->getFilterChain()
			  ->attachByName('StripTags')
			  ->attachByName('StringTrim');
  
		$email = new Input('email');
		$email->setAllowEmpty(TRUE);
		$email->getFilterChain()
			  ->attachByName('StripTags')
			  ->attachByName('StringTrim');
		
		$description = new Input('description');
		$description->setAllowEmpty(TRUE);
		$description->getFilterChain()
				    ->attachByName('StripTags')
				    ->attachByName('StringTrim');
  
		$this->add($category)
			 ->add($title)
			 ->add($priceMin)
			 ->add($priceMax)
			 ->add($expires)
			 ->add($city)
			 ->add($country)
			 ->add($name)
			 ->add($phone)
			 ->add($email)
			 ->add($description);
	}
} 
