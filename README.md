# Custom Sort Function

This PHP function sorts a multidimensional array by a specified key.

## Usage

Include the `customSort.php` file in your project and use the `customSort` function as shown in the example below:

```php
$inputArray = [
    ['name' => 'Alice', 'age' => 24],
    ['name' => 'Bob', 'age' => 21],
    ['name' => 'Charlie', 'age' => 23]
];

$sortedArray = customSort($inputArray, 'age', 'asc');
print_r($sortedArray);
```

Assumptions
The function assumes that all arrays within the input array are associative arrays with the same keys.
The sort key provided must exist in every associative array within the input array.
Requirements
PHP 7.0 or later.