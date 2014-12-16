<?php
namespace Search\Filter;

use Zend\Filter\FilterInterface;

class Float implements FilterInterface
{
	public function filter($value)
	{
		return (float) $value;
	}
}