<?php
namespace Search\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;

class SearchForm extends Form
{
	public function prepareElements(Array $categories)
	{
		$category = new Element\Select('category');
		$category->setLabel('Category')
				 ->setOptions(array('options' => $categories));
		
		$title = new Element\Text('title');
		$title->setLabel('Title')
			 ->setAttribute('title', 'Enter a suitable title for this posting')
			 ->setAttribute('size', 40)
			 ->setAttribute('maxlength', 128);

		$priceMin = new Element\Text('priceMin');
		$priceMin->setLabel('Minimum Price')
			  	 ->setAttribute('title', 'Enter mininum price as nnn.nn')
	 		  	 ->setAttribute('size', 16)
			  	 ->setAttribute('maxlength', 16);
		
		$priceMax = new Element\Text('priceMax');
		$priceMax->setLabel('Maximum Price')
			  	 ->setAttribute('title', 'Enter maximum price as nnn.nn')
	 		  	 ->setAttribute('size', 16)
			  	 ->setAttribute('maxlength', 16);
		
		$expires = new Element\Date('expires');
		$expires->setLabel('Expires')
			    ->setAttribute('title', 'The expiration date will be calculated from today')
				->setAttribute('size', 20)
				->setAttribute('maxlength', 20);
		
		$city = new Element\Text('city');
		$city->setLabel('Nearest City')
			  ->setAttribute('title', 'Select the city of the item')
			 ->setAttribute('size', 40)
			 ->setAttribute('maxlength', 255);
				
		$country = new Element\Text('country');
		$country->setLabel('Country Code')
			  ->setAttribute('title', 'Enter the 2 character ISO2 country code of the item')
			 ->setAttribute('size', 2)
			 ->setAttribute('maxlength', 2);
				
		$name = new Element\Text('name');
		$name->setLabel('Contact Name')
			 ->setAttribute('title', 'Enter the name of the person to contact for this item')
			 ->setAttribute('size', 40)
			 ->setAttribute('maxlength', 255);
		
		$phone = new Element\Text('phone');
		$phone->setLabel('Contact Phone Number')
			  ->setAttribute('title', 'Enter the phone number of the person to contact for this item')
			  ->setAttribute('size', 20)
			  ->setAttribute('maxlength', 32);
		
		$email = new Element\Email('email');
		$email->setLabel('Contact Email')
			  ->setAttribute('title', 'Enter the email address of the person to contact for this item')
			  ->setAttribute('size', 40)
			  ->setAttribute('maxlength', 255);

		$description = new Element\Textarea('description');
		$description->setLabel('Description')
					->setAttribute('title', 'Enter a suitable description for this posting')
					->setAttribute('rows', 4)
					->setAttribute('cols', 80);

		$submit = new Element\Submit('submit');
		$submit->setAttribute('value', 'Search')
			   ->setAttribute('title', 'Click here when done');
		
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
			 ->add($description)
			 ->add($submit);
	}
} 
