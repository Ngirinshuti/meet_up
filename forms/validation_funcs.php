<?php 
/**
 * The file for validating php fields
 *
 * PHP Version 8
 * 
 * @category Validation
 * @package  Unknown
 * @author   "ISHIMWE Valentin" <ishimwevalentin3@gmail.com>
 * @license  mitlicense.org MIT
 * @link     link
 */


/**
 * Error for failed validation field
 * 
 * @category Validation
 * @package  Unknown
 * @author   "ISHIMWE Valentin" <ishimwevalentin3@gmail.com>
 * @license  mitlicense.org MIT
 * @link     link
 */
class FieldError extends Exception
{
    // Something here if necessary
}


/**
 * Validator to validatate empty fields
 * 
 * @param string $field_name the name of the field to validate
 * @param bool   $bool       States whether field can be empty or not
 * @param $arr        The field's values array typically $_POST | $_GET
 * 
 * @return void
 */
function notEmpty(string $field_name, bool $bool, $arr)
{
    $value = isset($arr[$field_name]) ? trim(strval($arr[$field_name])) : "";
    $is_empty = $bool && $value !== "0" && empty($value);

    if ($is_empty) {
        throw new FieldEmpty("$field_name can't be empty");
    }
}

/**
 * Makes a given field required or not 
 * If required an not exist throws FieldDoesNotExist Exeption
 * 
 * @param string $field_name exists in an array
 * @param bool   $bool       States whether the field is required or not
 * @param array  $arr        the array where the field should exist 
 *                           typically $_POST|$_GET
 * 
 * @return void
 */
function required(string $field_name, bool $bool, $arr)
{
    $is_not_set = !isset($arr[$field_name]);
    if ($bool && $is_not_set) {
        throw new FieldDoesNotExist("$field_name is required");
    }
}

/**
 * Forces a given field value to start with a number or vice verse
 * 
 * @param string $field_name exists in an array
 * @param bool   $bool       States whether the field should 
 *                           start with number or not
 * @param array  $arr        the array where the field should exist 
 *                           typically $_POST|$_GET
 * 
 * @return void
 */
function startWithNum($field_name, bool $bool, $arr)
{
    $start_with_num = preg_match("/^\d/", $arr[$field_name]);
    throwError(!$bool && $start_with_num, "$field_name can't start with a number");
    throwError($bool && !$start_with_num, "$field_name must start with a number");
}

/**
 * Forces a given field value to be no longer than $max_len
 * 
 * @param string $field_name to be validated
 * @param int    $max_len    Maximum value length
 * @param array  $arr        the array where the field should exist 
 *                           typically $_POST|$_GET
 * 
 * @return void
 */
function maxLength($field_name, int $max_len, $arr)
{
    $length = strlen($arr[$field_name]);
    $more_than_len = $length > $max_len;
    throwError(
        $more_than_len, 
        "$field_name must have no more than $max_len characters"
    );
}

/**
 * Forces a given field value to have at least $min_len chars
 * 
 * @param string $field_name to be validated
 * @param int    $min_len    Manimum value length
 * @param array  $arr        the array where the field should exist 
 *                           typically $_POST|$_GET
 * 
 * @return void
 */
function minLength($field_name, int $min_len, $arr)
{
    $length = strlen($arr[$field_name]);
    $less_than_len = $length < $min_len;
    throwError(
        $less_than_len, 
        "$field_name must have at least $min_len characters"
    );
}

/**
 * Forces a given field value to contains only numbers or not contain only numbers
 * 
 * @param string $field_name to be validated
 * @param bool   $bool       States if the value must contain only numbers or 
 *                           can't contain only numbers 
 * @param array  $arr        the array where the field should exist 
 *                           typically $_POST|$_GET
 * 
 * @return void
 */
function isNumber($field_name, bool $bool, array $arr)
{
    $is_a_number = !preg_match("#\D#", $arr[$field_name]);
    throwError($bool && !$is_a_number, "$field_name should contain numbers only");
    throwError(!$bool && $is_a_number, "$field_name can't contain numbers only");
}

/**
 * Checks if a certain field value matches another field value
 * 
 * @param string $field_name       the field to be validated
 * @param string $match_field_name the field to be validated aginst
 * @param array  $arr              the array where both fields should exist 
 *                                 typically $_POST|$_GET 
 * 
 * @return void
 */
function shouldMatch(string $field_name, string $match_field_name,array $arr)
{
    $value_mismatch = isset($arr[$match_field_name]) ? !(
        $arr[$field_name] ===  $arr[$match_field_name]
    ) : true;

    throwError(
        $value_mismatch, 
        "$field_name should match $match_field_name"
    );
}


/**
 * Validate email
 *
 * @param string $field_name
 * @param string $rule_name
 * @param array $data 
 * 
 * @throws FieldError
 * @return void
 */
function email(string $field_name, string $rule_name, array $data)
{
    $value = filter_var($data[$field_name], FILTER_VALIDATE_EMAIL);
    throwError(!$value, "$field_name is not a valid email address");
}




/**
 * Throws field error whenever error occurs
 * 
 * @param $condition --- Should execption be thrown or not
 * @param $msg       -- error message of what just happened
 * 
 * @throws FieldError
 * @return void
 */
function throwError(bool $condition, string $msg)
{
    if ($condition) {
        throw new FieldError($msg);
    }
}