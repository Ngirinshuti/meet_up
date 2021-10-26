<?php

/**
 * Form validator file
 *
 * PHP Version 8
 * 
 * @category Validation
 * @package  Unknown
 * @author   "ISHIMWE Valentin" <ishimwevalentin3@gmail.com>
 * @license  mitlicense.org MIT
 * @link     link
 */

require "validation_funcs.php";
require "../token.php";

/**
 * Validator class
 
 * @category Validation
 * @package  Unknown
 * @author   "ISHIMWE Valentin" <ishimwevalentin3@gmail.com>
 * @license  mitlicense.org MIT
 * @link     link
 * */
class Validator
{
    public array $rules;
    public array $data;
    public array $errors = [];
    public array $valid_data = [];
    public bool $valid = false;
    public string $main_error = "";
    public string $success_msg = "";

    /**
     * Constructor
     *
     * @param array $rules fields rules
     * @param array $data  fields data
     */
    public function __construct(array $rules = [], array $data = [])
    {
        $this->rules = $rules;
        $this->data = array_merge($data, $_FILES);
    }

    /**
     * Set success_msg
     *
     * @param string $success_msg success message
     * 
     * @return Validator
     */
    public function setSuccessMsg(string $success_msg): Validator
    {
        $this->success_msg = $success_msg;
        return $this;
    }

    /**
     * Get success_msg
     *
     * @return string
     */
    public function getSuccessMsg(): string
    {
        return $this->success_msg;
    }

    /**
     * Set main error
     *
     * @param string $error error message
     * 
     * @return Validator
     */
    public function setMainError(string $error): Validator
    {
        $this->main_error = $error;
        return $this;
    }

    /**
     * Get main error
     *
     * @return string
     */
    public function getMainError(): string
    {
        return $this->main_error;
    }

    /**
     * Add rules
     *
     * @param array $rules rules
     * 
     * @return Validator
     */
    public function addRules(array $rules): Validator
    {
        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

    /**
     * Add data
     *
     * @param array $data data
     * 
     * @return Validator
     */
    public function addData(array $data): Validator
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }


    /**
     * Validate data against rules
     *
     * @return bool
     */
    public function validate(): bool
    {
        array_walk(
            $this->rules,
            function ($rules, $field) {
                try {
                    $this->validateField($field);
                } catch (FieldDoesNotExist | FieldEmpty $e) {
                    $this->addError($field, str_replace("_", " ", $e->getMessage()));
                }
            }
        );

        $this->valid = !boolval(count($this->getErrors()));

        return $this->valid;
    }

    /**
     * Remove session errors
     *
     * @return Validator
     */
    public function clearErrors(): Validator
    {
        $_SESSION['errors'] = [];
        unset($_SESSION['errors']);
        return $this;
    }

    /**
     * Save form data
     *
     * @return Validator
     */
    public function saveData(): Validator
    {
        $_SESSION['form_data'] = $this->data;
        return $this;
    }

    /**
     * Get field data
     *
     * @param string $field fieldname
     * 
     * @return mixed
     */
    public function data(string $field = "")
    {
        if (empty($field)) {
            return $this->data;
        }

        return  isset($this->data[$field]) ? $this->data[$field] : null;
    }

    /**
     * Run callback when method id post
     *
     * @param Closure $callback the callback
     * 
     * @return void
     */
    public function methodPost(Closure $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $csrf = new csrf();
            // Generate Token Id and Valid
            $token_id = $csrf->get_token_id();

            if ($csrf->check_valid('post')) {
                $callback($this);
            } else {
                exit("Page expired!");
            }
        }
    }


    /**
     * Save errors in the session
     *
     * @return Validator
     */
    public function saveErrors(): Validator
    {
        $_SESSION['errors'] = $this->getErrors();

        return $this;
    }

    /**
     * Get error messages
     *
     * @param string $field field name
     * 
     * @return array
     */
    public function getErrors(string $field = ""): array
    {
        if (isset($_SESSION['errors'])) {
            $this->errors = $_SESSION['errors'];
        }
        return !func_num_args() ? ($this->errors) : (isset($this->errors[$field]) ? $this->errors[$field] : []);
    }

    /**
     * Add and error message to the field
     *
     * @param string $field fieldname
     * @param string $msg   error msg
     * 
     * @return Validator
     */
    public function addError(string $field, string $msg): Validator
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [$msg];
            return $this;
        }

        array_push($this->errors[$field], $msg);

        return $this;
    }

    /**
     * Check if field has any error
     *
     * @param string $field fieldname
     * 
     * @return boolean
     */
    public function hasError(string $field): bool
    {
        return boolval(count($this->getErrors($field)));
    }

    /**
     * Print field error messages
     *
     * @param string $field fieldname
     * 
     * @return string errors in html
     */
    public function printErrors(string $field)
    {
        $output = "";

        foreach ($this->getErrors($field) as $error) {
            $error = ucfirst($error);
            $output .= <<<STR
                <div class="error">$error</div>
            STR;
        }

        return empty($output) ? "" : "<div class='errors'>$output</div>";
    }

    /**
     * Validate a single field
     *
     * @param string $field field name
     * 
     * @return Validator
     */
    public function validateField(string $field): Validator
    {
        $field_rules = $this->rules[$field];

        array_walk(
            $field_rules,
            function ($rule_constraint, $rule) use ($field) {

                if (is_int($rule)) {
                    $rule_handler = $this->snakeToCamelCase($rule_constraint);
                } else {
                    $rule_handler = $this->snakeToCamelCase($rule);
                }

                if (!function_exists($rule_handler)) {
                    exit("Rule handler '$rule_handler' don't exist");
                }

                try {
                    $rule_handler($field, $rule_constraint, $this->data);
                } catch (FieldError $e) {
                    $this->addError($field, $e->getMessage());
                }
            }
        );


        if (!count($this->getErrors($field))) {
            $value = $this->data($field) === "on" ? true : $this->data($field);
            $value = empty($this->data($field)) ? false : $this->data($field);
            $this->valid_data = array_merge($this->valid_data, [$field => $value]);
        }

        return $this;
    }


    /**
     * Convert the validator name to camel cased version function
     * 
     * @param string $validator_name The entered validator name
     * 
     * @return string camel case validator name
     */
    function snakeToCamelCase(string $validator_name): string
    {
        $str_arr = explode("_", $validator_name);
        if (count($str_arr) === 1) {
            return $str_arr[0];
        }
        $func_name =  array_reduce(
            $str_arr,
            function ($current, $word) use ($validator_name) {
                $pos = strpos($word, $validator_name);
                if (!empty($current)) {
                    $word[0] = strtoupper($word[0]);
                }
                return $current . $word;
            },
            ""
        );

        return $func_name;
    }

    /**
     * Validator helpers
     *
     * @return array
     */
    public function helpers(): array
    {

        $errors = fn ($name) => $this->printErrors($name);
        $data = fn ($name) => $this->data($name);
        $errorClass = fn ($name) => $this->hasError($name) ? "error" : "";
        $mainError = fn () => $this->getMainError() ? <<<ST
        <div class="formError">{$this->getMainError()}</div>
        ST : "";
        $success_msg = function () {
            $msg = $this->getSuccessMsg() ? $this->getSuccessMsg() : (
                isset($_SESSION["msg"]) ? $_SESSION["msg"] : ""
            );
            
            if (empty($msg)) {
                $msg = isset($_REQUEST["msg"]) ? $_REQUEST["msg"] : "";
            }

            return !empty($msg) ? <<<ST
                <div class="formMsg">$msg</div>
            ST : "";
    
        };

        return [$errors, $data, $errorClass, $mainError, $success_msg, $this->getCsrfField()];
        
    }
    
    function getCsrfField():Closure {
        $csrf = new csrf();
        
        // Generate Token Id and Valid
        $token_id = $csrf->get_token_id();
        $token_value = $csrf->get_token();
        $crsf_field = function() use ($token_id, $token_value){
            return <<<ST
            <input data-csrf type="hidden" name="$token_id" value="$token_value" />
            ST;
        };
        return $crsf_field;
    }
}


/**
 * Error for empty field
 * 
 * @category Validation
 * @package  Unknown
 * @author   "ISHIMWE Valentin" <ishimwevalentin3@gmail.com>
 * @license  mitlicense.org MIT
 * @link     link
 */
class FieldEmpty extends Exception
{
    // Something here if necessary
}

/**
 * Error for non existing field 
 * 
 * @category Validation
 * @package  Unknown
 * @author   "ISHIMWE Valentin" <ishimwevalentin3@gmail.com>
 * @license  mitlicense.org MIT
 * @link     link
 */

class FieldDoesNotExist extends Exception
{
    // Something here if necessary
}

/**
 * Error for non existing field 
 * 
 * @category Validation
 * @package  Unknown
 * @author   "ISHIMWE Valentin" <ishimwevalentin3@gmail.com>
 * @license  mitlicense.org MIT
 * @link     link
 */

class FormError extends Exception
{
    // Something here if necessary
}
