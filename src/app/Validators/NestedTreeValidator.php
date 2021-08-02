<?php

namespace Api\Validators;

use Api\Exceptions\NestedTreeValidatorException;

class NestedTreeValidator extends Validator
{
    /**
     * @var string[]
     */
    protected $allowedFields = [
        'node_id',
        'language',
        'search_keyword',
        'page_num',
        'page_size',
    ];


    /**
     * Validate fields
     *
     * @return mixed|void
     * @throws NestedTreeValidatorException
     */
    public function validate()
    {
        if (
            !isset($this->fields['node_id'])
            ||
            !is_numeric($this->fields['node_id'])
        ) {
            throw new NestedTreeValidatorException('Missing mandatory params', 400);
        }


        if (
            !isset($this->fields['language'])
            ||
            !in_array($this->fields['language'], ['italian', 'english'])
        ) {
            throw new NestedTreeValidatorException('Missing mandatory params', 400);
        }


        if (
            isset($this->fields['page_num'])
            &&
            (
                !is_numeric($this->fields['page_num'])
                ||
                $this->fields['page_num'] < 0
            )
        ) {
            throw new NestedTreeValidatorException('Invalid page number requested', 400);
        }


        if (
            isset($this->fields['page_size'])
            &&
            (
                !is_numeric($this->fields['page_size'])
                ||
                $this->fields['page_size'] < 0
                ||
                $this->fields['page_size'] > 1000
            )
        ) {
            throw new NestedTreeValidatorException('Invalid page size requested', 400);
        }
    }
}