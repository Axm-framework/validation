<?php

declare(strict_types=1);

namespace Axm\Validation;

use Axm;
use Axm\Exception\AxmException;

/*
 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Validator
{
    public array $Validators = [

        'required' => 'Axm\Validation\Rules\Required',
        'email' => 'Axm\Validation\Rules\Email',
        'min' => 'Axm\Validation\Rules\Min',
        'max' => 'Axm\Validation\Rules\Max',
        'alpha' => 'Axm\Validation\Rules\Alpha',
        'alnum' => 'Axm\Validation\Rules\Alnum',
        'string' => 'Axm\Validation\Rules\Text',
        'equal' => 'Axm\Validation\Rules\Equals',
        'dir' => 'Axm\Validation\Rules\Directory',
        'phone' => 'Axm\Validation\Rules\Phone',
        'numeric' => 'Axm\Validation\Rules\Numeric',
        'number' => 'Axm\Validation\Rules\Number',
        'positive' => 'Axm\Validation\Rules\Positive',
        'negative' => 'Axm\Validation\Rules\Negative',
        'decimal' => 'Axm\Validation\Rules\Decimal',
        'int' => 'Axm\Validation\Rules\Intenger',
        'consonant' => 'Axm\Validation\Rules\Consonant',
        'date' => 'Axm\Validation\Rules\Date',
        'time' => 'Axm\Validation\Rules\Time',
        'slug' => 'Axm\Validation\Rules\Slug',
        'finite' => 'Axm\Validation\Rules\Finite',
        'infinite' => 'Axm\Validation\Rules\Infinite',
        'lower' => 'Axm\Validation\Rules\Lower',
        'uppercase' => 'Axm\Validation\Rules\Uppercase',
        'isbn' => 'Axm\Validation\Rules\Isbn',
        'iban' => 'Axm\Validation\Rules\Iban',
        'nif' => 'Axm\Validation\Rules\Nif',
        'nip' => 'Axm\Validation\Rules\Nip',
        'file' => 'Axm\Validation\Rules\File',
        'size' => 'Axm\Validation\Rules\Size',
        'fibonacci' => 'Axm\Validation\Rules\Fibonacci',
        'null' => 'Axm\Validation\Rules\Null',
        'url' => 'Axm\Validation\Rules\Url',
        'unique' => 'Axm\Validation\Rules\Unique',
        'array' => 'Axm\Validation\Rules\IsArray',
        'postalcode' => 'Axm\Validation\Rules\PostalCode',
        'compare' => 'Axm\Validation\Rules\Comparison',
        'true' => 'Axm\Validation\Rules\True',
        'false' => 'Axm\Validation\Rules\False',
        'json' => 'Axm\Validation\Rules\Json',
        'leapdate' => 'Axm\Validation\Rules\LeapDate',
        'leapyear' => 'Axm\Validation\Rules\LeapYear',
        'mac' => 'Axm\Validation\Rules\MacAddress',
        'oject' => 'Axm\Validation\Rules\Object',
        'odd' => 'Axm\Validation\Rules\Odd', //si es par
        'pis' => 'Axm\Validation\Rules\Pis',
        'link' => 'Axm\Validation\Rules\Link',
        'regex' => 'Axm\Validation\Rules\Regex',

        'match' => 'Axm\Validation\Rules\EmailValidator',
        'captcha' => 'Axm\Validation\Rules\EmailValidator',

    ];

    private $instances = [];

    private  $separator = '|';
    private  $equals  = ':';
    private  $grouper_open  = '[';
    private  $grouper_close = ']';

    protected $currentOperator;

    private  $not = '!';

    public array $rules = [];

    public $data;
    /**variables donde se guardan todos los errores */

    public array $errors = [];
    public array $countErrors = [];
    private array $occurrencesErrors = [];

    public $skipValidation = false;
    public $validationRules = [];

    protected $validationMessage = [];

    public $_input;
    protected $class;

    protected $errorMessage =
    [
        'required'   => 'The field {{field}} is required',
        'email'      => 'The field must be valid email address',
        'min'        => 'Min length of the field {{field}} must be {{min}}',
        'max'        => 'Max length of the field {{field}} must be {{max}}',
        'match'      => 'The field must be the same as {match}',
        'size'       => 'Size of the {{field}} must be {size}',
        'equals'     => 'This field must be equal to the {{field}} field.',
        'same'       => 'This field must be equal to the {{field}} field.',
        'compare'    => 'The field {{field}} not is {{operator}} to field {{value}}',
        'unique'     => 'Record with The {{field}} already exists',
        'alpha'      => 'The field {{field}} is text',
        'alnum'      => 'The field {{field}} is alphanumeric',
        'numeric'    => 'The field {{field}} is numeric',
        'phone'      => 'This phone format is wrong',
        'file'       => 'File invalid',
        'number'     => 'The field {{field}} is number',
        'positive'   => 'The field {{field}} is positive number',
        'negative'   => 'The field {{field}} is positive negative',
        'decimal'    => 'The field {{field}} is decimal',
        'integer'    => 'The field {{field}} is integer',
        'nif'        => 'The field {{field}} is nif',
        'array'      => 'The field {{field}} is array',
        'text'       => 'The field {{field}} is string',
        'postalcode' => 'The field {{field}} is invalid',
        'dir'        => 'The field {{field}} is dir',
        'lower'      => 'The field {{field}} is lower',
        'uppercase'  => 'The field {{field}} is uppercase',
        'consonant'  => 'The field {{field}} is consonant',
        'date'       => 'The field {{field}} is date',   //revisar
        'time'       => 'The field {{field}} is time',   //revisar
        'slug'       => 'The field {{field}} is slug',
        'finite'     => 'The field {{field}} is finite',
        'infinite'   => 'The field {{field}} is infinite',
        'isbn'       => 'The field {{field}} is isbn',
        'iban'       => 'The field {{field}} is incorrect',
        'nif'        => 'The field {{field}} is incorrect',
        'fibonacci'  => 'The field {{field}} is number fibonacci',
        'null'       => 'The field {{field}} is null',
        'url'        => 'The field {{field}} is url',
        'card'       => 'The number card invalid',
        'true'       => 'The field {{field}} is true',
        'false'      => 'The field {{field}} is false',
        'json'       => 'The field {{field}} is json',
        'leapdate'   => 'The field {{field}} is leapdate',
        'leapyear'   => 'The field {{field}} is leadyear',
        'mac'        => 'The field {{field}} is mac address',
        'oject'      => 'The field {{field}} is object',
        'odd'        => 'The field {{field}} is odd', //si es par
        'pis'        => 'The field {{field}} is pis',
        'link'       => 'The field {{field}} is link',


        //not
        '!required'   => 'The field {{field}} no is required',
        '!email'      => 'The field no must be valid email address',
        '!alpha'      => 'The field no is text',
        '!alnum'      => 'The field no is alphanumeric',
        '!numeric'    => 'The field no is numeric',
        '!phone'      => 'Este formato no de telefono es incorrecto',
        '!file'       => 'File no valid',
        '!number'     => 'The field no is number',
        '!positive'   => 'The field no is positive number',
        '!negative'   => 'The field no is positive negative',
        '!decimal'    => 'The field no is decimal',
        '!integer'    => 'The field no is integer',
        '!nif'        => 'The field no is nif',
        '!array'      => 'The field no is array',
        '!text'       => 'The field no is string',
        '!postalcode' => 'Postal code no invalid',
        '!dir'        => 'The field no is dir',
        '!lower'      => 'The field no is lower',
        '!uppercase'  => 'The field no is uppercase',
        '!consonant'  => 'The field no is consonant',
        '!date'       => 'The field no is date',   //revisar
        '!time'       => 'The field no is time',   //revisar
        '!slug'       => 'The field no is slug',
        '!finite'     => 'The field no is finite',
        '!infinite'   => 'The field no is infinite',
        '!isbn'       => 'The field no is isbn',
        '!iban'       => 'The field no is iban',
        '!nif'        => 'The field no is nif',
        '!fibonacci'  => 'The field no is number fibonacci',
        '!null'       => 'The field no is null',
        '!url'        => 'The field no is url',
        '!card'       => 'The number no card invalid',
        '!true'       => 'The field no is true',
        '!false'      => 'The field no is false',
        '!json'       => 'The field no is json',
        '!leapdate'   => 'The field no is leapdate',
        '!leapyear'   => 'The field no is leadyear',
        '!mac'        => 'The field no is mac address',
        '!oject'      => 'The field no is object',
        '!odd'        => 'The field no is odd', //si es par
        '!pis'        => 'The field no is pis',
        '!link'       => 'The field no is link'
    ];


    /**
     * Create instance validator.
     */
    public static function createValidator($name, $attributes, $params = []): self
    {
        return new self();
    }

    // /**
    //  * 
    //  */
    // public function validate($data = null): bool
    // {
    //     // $this->data = $data ?? Axm::app()->request->post();
    //     $this->data = $data;

    //     return $this->startValidation();
    // }

    // /**
    //  * 
    //  */
    // public function startValidation()
    // {
    //     if ($this->skipValidation) {
    //         return true;
    //     }

    //     foreach ($this->validationRules as $attribute => $rulesPack) {

    //         $valueOfAttribute = $this->data[$attribute] ?? '';

    //         $rules = $this->extractRulesAndParameters($rulesPack);

    //         foreach ($rules as $rule) {

    //             $return = $this->validateAttribute($attribute, $valueOfAttribute, $rule);

    //             if ($return === false) {
    //                 $this->addErrorByRule($attribute, $rule, [$valueOfAttribute, $rule]);
    //             }
    //         }
    //     }

    //     return true;
    // }


    // *********************************************************************************************************


    public function validaten(array $rulePack): bool
    {
        $this->data = $rulePack;
        $this->reset(false);

        foreach ($this->validationRules as $attr => $rules) {

            if (!isset($this->data[$attr])) {
                continue;         // Saltar si el valor no existe en el array de datos.
            }

            $rules = array_filter(explode($this->separator, $rules));
            $cnt   = count($rules);
            foreach ($rules as $i => $ruleItem) {

                $parameters = [];
                if (strpos($ruleItem, ':') !== false) {
                    [$rule, $parameter] = explode(':', $ruleItem, 2);
                    $parameters = explode(',', $parameter);


                    #si regla es same la compila
                    if ($rule == 'same') {
                        if (array_key_exists($parameter, $this->data)) {

                            $parameters = $this->data[$parameter] ?? null;
                        }
                    }


                    #si regla es unique la compila
                    if ($rule == 'unique') {
                        if (array_key_exists($parameter, $this->data)) {

                            $value      = $this->data[$attr];
                            $parameters = $this->data[$parameter] ?? null;
                        }
                    }


                    #si existen reglas de comparacion las compila
                } elseif (!empty($return = $this->compileComparisonRules($ruleItem))) {

                    $rule = 'compare';
                    $parameters = [
                        'value'    => $return,
                        'operator' => $this->currentOperator
                    ];


                    #Si la regla es un file
                } elseif ($this->isFileAttribute($ruleItem, $attr)) {
                    echo 'es un afile';                    // $this->isRequiredFile($rule, $attr);
                    dd(
                        $ruleItem,
                        $attr,
                    );




                    #tt
                } else {
                    $rule = $ruleItem;
                }


                if ($i + 1 > $cnt) {
                    continue;
                } 
                // else {

                    $value = $this->data[$attr] ?? null;    //Obtener el valor del campo de entrada
                // }


                #valida las rules y agrega error si existe
                $this->executeRule($rule, $attr, $value, $parameters);
            }
        }

        # Verificar si hay errores y devolver el resultado
        return empty($this->errors);
    }


    /**
     * Compara si en las reglas de validacion existen algun operador de comparacion
     * estos pueden ser: ('<=','>=','===','==','!=','!==','<','>')
     */
    private function compileComparisonRules(string $rule)
    {
        $pattern = '/(?:<=|>=|===|==|!=|!==|[<>])\s*(.*)$/';
        preg_match($pattern, $rule, $matches);
        return !empty($matches) ? $this->extractComparisonSign($matches) : false;
    }


    /**
     * 
     */
    private function extractComparisonSign(array $matches)
    {
        if (!empty($matches)) {
            [$operator, $value] = $matches;

            $this->currentOperator = str_replace($value, '', $operator);
            return $value;
        }

        return false;
    }


    /**
     * 
     */
    private function isFileAttribute(string $rule, string $attribute): bool
    {
        return $rule === 'file' && array_key_exists($attribute, $_FILES);
    }


    /**
     * 
     */
    private function isRequiredFile(string $rule, ?string $attribute): bool
    {
        if ($rule !== 'required' || empty($attribute) || !isset($_FILES[$attribute])) {
            return false;
        }

        return !empty($_FILES[$attribute]['tmp_name']);
    }


    /**
     * 
     */
    private function executeRule($rule, $attr, $value, $parameters): void
    {
        $validator = $this->instantiateClass($rule);
        if (!$validator->validate($value, $parameters)) {
            $this->addErrorByRule($attr, $rule, [$rule => $parameters[0] ?? $value]);
        }
    }



    /**
     * 
     */
    public function instantiateClass(string $classRuleName, string $method = 'validate'): object
    {
        if (empty($classRuleName)) {
            throw new AxmException(Axm::t('Axm', 'El nombre de la clase no puede esar vacio.'));
        }

        $class = 'Axm\\Validation\\Rules\\' .  ucfirst($classRuleName);
        if (!isset($this->instances[$class])) {
            if (!class_exists($class)) {
                throw new AxmException(Axm::t('Axm', 'La clase de validacion "%s" no existe.', [
                    $class,
                ]));
            }

            $instance = $this->instances[$class] = new $class;

            if (!method_exists($instance, $method)) {
                throw new AxmException(Axm::t('Axm', 'El método "%s" no existe en la clase "%s".', [
                    $method, $class,
                ]));
            }
        }

        return $this->instances[$class];
    }


    /**
     * Esta función sirve para contar las ocurrencias de cada regla utilizando un caché de archivos
     * @param string $rule
     * @return int|false
     */
    public function countOccurrencesErrors(string $rule = null)
    {
        if (!empty($rule)) {
            $cacheKey  = '__occurrencesErrors__' . $rule;
            $cacheFile = STORAGE_PATH . '/framework/cahe/' . $cacheKey . '.txt';

            if (file_exists($cacheFile)) {
                $count = (int) file_get_contents($cacheFile);
                $count++;
            } else {
                $count = 1;
            }

            file_put_contents($cacheFile, $count);

            $this->countErrors = [
                'rule'  => $rule,
                'count' => $count,
            ];

            return $this->countErrors['count'];
        }

        return false;
    }


    /**
     * Esta función reinicia el archivo de caché y las ocurrencias de una regla
     * @param string $rule
     * @return bool
     */
    public function resetOccurrencesErrors(string $rule = null): bool
    {
        if (!empty($rule)) {
            $cacheKey  = '__occurrencesErrors__' . $rule;
            $cacheFile = STORAGE_PATH . '/framework/cahe/' . $cacheKey . '.txt';

            if (file_exists($cacheFile)) {
                unlink($cacheFile);
            }

            return true;
        }

        return false;
    }


    /**
     * Esta función borra todos los archivos de caché de una dirección
     * @param string $cacheDirectory
     * @return bool
     */
    public function clearCacheDirectory(string $cacheDirectory): bool
    {
        if (is_dir($cacheDirectory)) {
            $files = glob($cacheDirectory . '/*.txt');

            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            return true;
        }

        return false;
    }

    // *********************************************************************************************************



    /**
     * Class Rule Single
     * si encuentra la rule class en todas las reglas de validación
     * entonce  intanciará la clase y llamará al metodo validate 
     * @param string $rule la regla de validación a comprobar.
     * @param mixed $attribute el atributo a validar.
     * @return bool devuelve true si la validación es exitosa, o false si no lo es.
     */
    public function isSingleRule(string $rule, $attribute): bool
    {
        #instanciar la rule class
        $this->instantiateClass($rule);

        if ($this->class->validate($attribute)) {
            return true;
        }

        $this->addErrorByRule($attribute, $rule, ['field' => $attribute]);
        return false;
    }





    /**
     * 
     */
    private function hasNegationRule(string $rule): bool
    {
        return strpos($rule, $this->not) !== false;
    }


    /**
     * 
     */
    private function validateEqualsAttribute(string $attribute, string $valueAttribute, string $rule): bool
    {
        $attribute = $this->extractAttributeNameFromRules($rule, $this->equals);
        $this->instantiateClass('equal');
        $attributeToCompare = $this->data[$attribute] ?? [];

        if (!$this->class->validate($valueAttribute, $attributeToCompare)) {
            $this->addErrorByRule($attribute, 'equals', ['field' => $attribute]);
            return false;
        }

        return true;
    }



    /**
     * 
     */
    private function isUniqueAttribute(string $rule, string $attribute): bool
    {
        $unique = 'unique' . $this->grouper_open;
        return strpos($rule, $unique) === 0 && substr($rule, -1) === $this->grouper_close;
    }

    /**
     * 
     */
    private function extractUniqueTableName(string $rule): string
    {
        $unique = 'unique' . $this->grouper_open;

        if (!strpos($rule, $unique)) {
            throw new \InvalidArgumentException('La regla de validación no es única.');
        }

        $uniqueParts = explode($unique, $rule);

        if (count($uniqueParts) < 2) {
            throw new \InvalidArgumentException('No se puede extraer el nombre de la tabla de la regla de validación.');
        }

        $uniqueTableName = rtrim($uniqueParts[1], $this->grouper_close);

        if (empty($uniqueTableName)) {
            throw new \InvalidArgumentException('No se puede extraer el nombre de la tabla de la regla de validación.');
        }

        return $uniqueTableName;
    }



    /**
     * 
     */
    protected function addErrorByRule(string $field, string $rule, array $messageParams = []): void
    {
        $messageParams['field'] = $field;

        if (!array_key_exists($rule, $this->errorMessage)) {
            throw new AxmException(Axm::t('Axm', 'Invalid validation rule "%s"', [
                $rule
            ]));
        }

        $errorMessage = $this->errorMessage[$rule];

        // Buscar las variables en el mensaje de error y reemplazarlas
        preg_match_all('/{{(.*?)}}/', $errorMessage, $matches);
        foreach ($matches[1] as $variable) {
            if (isset($messageParams[$variable])) {
                $errorMessage = str_replace('{{' . $variable . '}}', $messageParams[$variable], $errorMessage);
            }
        }

        $this->errors[$field][] = [
            'rule'    => $rule,
            'message' => $errorMessage
        ];
    }


    /**
     * Esta funcion sirve para resetear la cuenta de ocurrencia de erroes de una rule.
     * */
    public function resetCountError(string $rule)
    {
        unset($this->occurrencesErrors[$rule]);
    }

    /**
     * Esta funcion sirve para resetear la cuenta de ocurrencia de erroes de una rule
     * */
    public function resetCountErrors(array $rules)
    {
        foreach ($rules as $rule) {
            unset($this->occurrencesErrors[$rule]);
        }
    }


    /**
     * 
     */
    public function addError(string $field, string $rule, string $message = '')
    {
        $message = $message ?: $this->errorMessage[$rule];
        $this->errors[$field][] = [
            'rule'    => $rule,
            'message' => $message
        ];
        $this->rules[] = $rule;
        $this->countOccurrencesErrors($rule);
    }

    /**
     * 
     */
    public function setRules(array $rules): bool
    {
        if (empty($rules)) {
            return false;
        }

        $this->reset();
        $this->validationRules = $rules;

        return true;
    }

    /**
     * Agrega las reglas asignadas a la reglas de validacion.
     *
     * @param array $rules */
    public function addRules(array $rules)
    {
        $this->validationRules = array_replace_recursive($this->validationRules, $rules);
        return $this;
    }

    /**
     * Devuelve todas las reglas de validacion.
     *
     * @param array $rules */
    public function getRules()
    {
        return $this->validationRules;
    }


    /**
     * Modifica en la lista de mensajes errores un nuevo mensaje, con un message 
     * ej: $model->setError('email', 'required', 'este campo debe de ser un email');
     * 
     * @param string $fields 
     * @param string $rule 
     * @param string $newMessage */
    public function setError(string $field, string $rule, string $newMessage)
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }

        $addError = [
            'rule'    => $rule,
            'message' => $newMessage
        ];

        $this->errors[$field][] = $addError;
    }


    /**
     * Devuelve el error del campo solicitado si existe sino false
     * 
     * @param string $fields  */
    public function hasError($fields)
    {
        return $this->errors[$fields] ?? false;
    }


    /**
     * 
     */
    public function getFirstErrorByField(string $field): string
    {
        if (!array_key_exists($field, $this->errors)) {
            return '';
        }

        $errors = $this->errors[$field];
        if (count($errors) === 0) {
            return '';
        }

        $firstError = reset($errors);
        return $firstError['message'];
    }


    /**
     * Devuelve todos los errores existentes en la lista
     * @return string
     */
    public function getErrors()
    {
        $messages = [];
        foreach ($this->errors as $value) {
            foreach ($value as $item) {
                if (isset($item['message'])) {
                    $messages[] = $item['message'];
                }
            }
        }

        return $messages;
    }


    /**
     * Devuelve todos los errores existentes en la lista
     * @return string
     */
    public function getFirstError(): string
    {
        if (empty($this->errors)) {
            return '';
        }

        $firstError = reset($this->errors);
        if (is_array($firstError) && isset($firstError[0]['message'])) {
            return (string) $firstError[0]['message'];
        }

        return '';
    }

    /**
     * Validates the first field in the data array and returns an error message if there is one.
     *
     * @return string|null The error message or null if there are no errors.
     */
    public function validateOne(): ?string
    {
        // Get the first field in the data array.
        $field = array_key_first($this->data);

        // If the field is empty, return null.
        if (!isset($field) || $field === '') {
            return null;
        }

        try {
            // Get the first error message for the field.
            $errorMessage = $this->getFirstErrorByField((string) $field);

            // If there is an error message, return it.
            if (!empty($errorMessage)) {
                return show($errorMessage);
            }
        } catch (\Exception $e) {
            // Handle any exceptions thrown by getFirstErrorByField().
            // Log or display the error message as needed.
            error_log($e->getMessage());
        }

        // If there are no errors, return null.
        return null;
    }

    /**
     * Resets the class to a blank slate. Should be called whenever
     * you need to process more than one array.  */
    public function reset(bool $resetValidationRules = true)
    {
        $this->rules  = [];
        $this->errors = [];

        if ($resetValidationRules) {
            $this->validationRules = [];
        }

        return $this;
    }


    /**
     *********************************************************************************************************
     *********************************************************************************************************
     ************************************************************************************************************* 
     */
    public function validaten2(array $rulePack): bool
    {
        $this->data = $rulePack;
        $this->reset(false);

        foreach ($this->validationRules as $attr => $rules) {
            if (!isset($this->data[$attr])) {
                continue; // Saltar si el valor no existe en el array de datos.
            }

            $rules = array_filter(explode($this->separator, $rules));

            foreach ($rules as $ruleItem) {
                $parameters = $this->parseRuleParameters($ruleItem, $attr);
                $value      = $this->data[$attr] ?? null;

                $this->executeRule($ruleItem, $attr, $value, $parameters);
            }
        }

        return empty($this->errors);
    }

    private function parseRuleParameters(string $ruleItem, string $attr): array
    {
        $parameters = [];

        if (strpos($ruleItem, ':') !== false) {
            [$rule, $parameter] = explode(':', $ruleItem, 2);
            $parameters = explode(',', $parameter);

            if ($rule === 'same' || $rule === 'unique') {
                $parameters = $this->resolveRuleParameter($rule, $attr, $parameters);
            }
        } else {
            $rule = $ruleItem;
        }

        return [
            'rule'       => $rule,
            'parameters' => $parameters,
        ];
    }

    private function resolveRuleParameter(string $rule, string $attr, array $parameters): array
    {
        if (array_key_exists($parameters[0], $this->data)) {
            $value      = $this->data[$attr];
            $parameters = $this->data[$parameters[0]] ?? null;

            if ($rule === 'same') {
                $parameters = $value;
            }
        }

        return $parameters;
    }
}
