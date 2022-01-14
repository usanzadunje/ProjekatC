<?php

namespace Tests;


abstract class FormRequestTestCase extends TestCase
{

    public function setUp(): void {
        parent::setUp();

        $formClass = str_replace('Test', '', class_basename($this));
        $formClass = "App\Http\Requests\\$formClass";

        $this->rules = (new $formClass())->rules();
        $this->validator = $this->app['validator'];
    }

    /**
     * Returns validator instance for current field with
     */
    protected function getFieldValidator(string $field, mixed $value) {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        );
    }

    /**
     * Validates value against corresponding rules.
     */
    protected function validateField($field, $value) {
        return $this->getFieldValidator($field, $value)->passes();
    }
}
