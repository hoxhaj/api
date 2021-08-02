<?php

namespace Api\Validators;

abstract class Validator implements ValidatorInterface
{
    /**
     * Incoming fields to be validated
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Restrict valid fields to avoid injection in the request of not required fields
     *
     * @var array
     */
    protected $allowedFields = [];


    /**
     * Validator constructor.
     *
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }


    /**
     * Return only allowed and cleaned fields
     *
     * @return array
     */
    public function valid()
    {
        return $this->clean();
    }


    /**
     * Return cleaned fields (simple cleaning)
     *
     * @return array
     */
    private function clean()
    {
        $cleaned = [];

        foreach ($this->allowedFields as $field)
        {
            if (isset($this->fields[$field]))
            {
                $cleaned[$field] = strip_tags($this->fields[$field]);
            }
        }

        return $cleaned;
    }
}