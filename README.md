# Custom Sorting Function in PHP

This project implements a custom sorting function in PHP that allows sorting arrays of associative arrays by a specified key and order. The function supports various sorting options, including case-sensitive, case-insensitive, and natural order comparisons. The sorting logic is encapsulated in an enum class `SortOrder`, which provides different comparison methods.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
  - [Available Sort Orders](#available-sort-orders)
  - [Examples](#examples)
- [Testing](#testing)
- [Implementation Details](#implementation-details)
  - [SortOrder Enum](#sortorder-enum)
  - [customSort Function](#customsort-function)
- [Contributing](#contributing)
- [License](#license)

## Overview

The custom sorting function in this project allows developers to sort arrays of associative arrays by a specified key and sorting order. The sorting can be done in ascending or descending order and supports both case-insensitive and natural order sorting.

## Features

- **Multiple Sorting Orders:** Sort in ascending, descending, case-insensitive, and natural order.
- **Customizable:** Easily extendable by adding new sorting orders.
- **Error Handling:** Handles non-existing keys and invalid sort orders gracefully.
- **Optimized Sorting:** Uses an optimized bubble sort for small datasets.

## Installation

Clone the repository to your local machine:

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
```


## Usage

### Available Sort Orders

The `SortOrder` enum provides the following sorting options:

- `ASC`: Ascending order.
- `DESC`: Descending order.
- `CASE_INSENSITIVE_ASC`: Case-insensitive ascending order.
- `CASE_INSENSITIVE_DESC`: Case-insensitive descending order.
- `NATURAL_ASC`: Natural ascending order (e.g., "item2" before "item10").
- `NATURAL_DESC`: Natural descending order.

### Examples

```php
require_once 'src/customSort.php';

// Example 1: Ascending sort by 'age'
$input = [
    ['name' => 'Alice', 'age' => 24],
    ['name' => 'Bob', 'age' => 21],
    ['name' => 'Charlie', 'age' => 23]
];

$resultAsc = customSort($input, 'age', 'asc');
print_r($resultAsc);

// Example 2: Case-insensitive ascending sort by 'name'
$input = [
    ['name' => 'alice', 'age' => 24],
    ['name' => 'Bob', 'age' => 21],
    ['name' => 'Charlie', 'age' => 23]
];

$resultCaseInsensitiveAsc = customSort($input, 'name', 'case_insensitive_asc');
print_r($resultCaseInsensitiveAsc);

// Example 3: Natural ascending sort by 'name'
$input = [
    ['name' => 'item10', 'age' => 24],
    ['name' => 'item2', 'age' => 21],
    ['name' => 'item1', 'age' => 23]
];

$resultNaturalAsc = customSort($input, 'name', 'natural_asc');
print_r($resultNaturalAsc);
```

## Testing

The project includes a test suite to verify the correctness of the custom sorting function. To run the tests, execute the following command:

```bash
php tests/CustomSortTest.php
```

The test suite covers various scenarios, including:

- Sorting by different keys.
- Sorting in ascending, descending, case-insensitive, and natural order.
- Handling non-existing keys and invalid sort orders.
- Ensuring correct behavior with mixed data types.

## Implementation Details

### SortOrder Enum

The `SortOrder` enum defines the supported sorting orders and provides a `compare` method that handles the comparison logic for each case. The enum also includes a `fromString` method to safely convert a string input into the corresponding `SortOrder` enum case.

### customSort Function

The `customSort` function sorts an array of associative arrays by a specified key and order. It uses an optimized bubble sort algorithm and leverages the `SortOrder` enum for comparison logic. The function validates the existence of the sort key and ensures that only scalar values are used for sorting.

## Contributing

Contributions are welcome! If you would like to contribute to this project, please fork the repository and submit a pull request. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License.
