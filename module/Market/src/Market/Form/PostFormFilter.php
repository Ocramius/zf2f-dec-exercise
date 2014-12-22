<?php

namespace Market\Form;

use Market\Validator\InCategories;
use Zend\Filter\StringToLower;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\I18n\Validator\Alnum;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\InArray;
use Zend\Validator\StringLength;

class PostFormFilter extends InputFilter
{
    public function __construct(array $categories)
    {
        $category = new Input('category');

        $category
            ->getValidatorChain()
            ->attach(new InCategories($categories));

        $category->getFilterChain()->attach(new StripTags());
        $category->getFilterChain()->attach(new StringTrim());
        $category->getFilterChain()->attach(new StringToLower());

        $title = new Input('title');

        $title->getValidatorChain()->attach(new Alnum());
        $title->getValidatorChain()->attach(new StringLength([
            'min' => 1,
            'max' => 255,
        ]));

        $title->getFilterChain()->attach(new StripTags());
        $title->getFilterChain()->attach(new StringTrim());

        $this->add($category);
        $this->add($title);
    }
}
