<?php

namespace Market\Validator;

use Zend\Validator\InArray;

class InCategories extends InArray
{
    /**
     * @var string[]
     */
    protected $messageTemplates = array(
        self::NOT_IN_ARRAY => 'The input does not match any known category',
    );

    /**
     * @param string[] $categories
     */
    public function __construct(array $categories)
    {
        parent::__construct([
            'haystack' => $categories,
            'strict'   => InArray::COMPARE_STRICT,
        ]);
    }
}
