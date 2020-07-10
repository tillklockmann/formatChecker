# FormatChecker
Define Validation checks for key-value user input Array.

## Usage
create a validation class that extends ```AbstractFormatChecker``` 

```php
class ValidationChecks extends AbstractFormatChecker
{

}
```
Instantiate the class with a key - value array:
```php
$input = [
    'name' => 'Hani',
];
$validation = new ValidationChecks($input);
```
Add checks for a key like this
```php
$validation->addCheck('name', 'required');
```
ValidationChecks::addCheck(string $key, string $function_name)

The second argument for addCheck is going to be used to identify the function that performs the check. The function name is prepended with 'check_'. So the function you have to implement is 'check_function_name'.
```php
class ValidationChecks extends AbstractFormatChecker
{
    protected function check_required($name, $args = [])
    {
        if (!isset($this->params[$name])) {
            throw new Exception('Param ' . $name . ' must be set.', 100);
        }
    }
}
```
You add another check with a pipe
```php
$validation->addCheck('name', 'required|string');
```
You can define an argument for the check by adding it with colon:
```php
$validation->addCheck('name', 'required|string|max_strlen:10');
```
You retrieve the arg from the second param of the check_ ... function:
```php
class ValidationChecks extends AbstractFormatChecker
{
    protected function check_max_strlen($name, $args = [])
    {
        $max = $args['max_strlen'];
        $value = $this->params[$name];
        if (strlen($value) > $max) {
            $this->params[$name] = mb_strimwidth($value, 0, $max, null, 'UTF-8');
        }
        $this->params[$name] = $value;
    }
}
```