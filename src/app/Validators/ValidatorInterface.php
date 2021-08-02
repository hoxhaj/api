<?php

namespace Api\Validators;

interface ValidatorInterface
{
    /**
     * Validate fields
     *
     * @return mixed
     */
    public function validate();

    /**
     * Only allowed and cleaned fields
     *
     * @return mixed
     */
    public function valid();
}