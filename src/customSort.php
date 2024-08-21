<?php

require_once __DIR__ . '/../src/SortOrder.php';

/**
 * Custom sort function to sort an array of associative arrays by a specified key and sort order.
 *
 * This function sorts an array of associative arrays based on the value of a specific key within
 * each array. The sort order is determined by the provided SortOrder enum. The function uses
 * a bubble sort algorithm optimized with an early exit if the array becomes sorted before
 * completing all passes.
 *
 * @param array $input The input array of associative arrays to be sorted.
 * @param string $sortKey The key within each associative array by which to sort.
 * @param string $sortOrder The sorting order as a string (e.g., 'asc', 'desc').
 * @return array The sorted array.
 * @throws InvalidArgumentException If the sort key does not exist or if the values are not scalar.
 */
function customSort(array $input, string $sortKey, string $sortOrder): array {

    // Convert the sort order string to a SortOrder enum instance.
    $sortOrder = SortOrder::fromString(strtolower($sortOrder));

    // Validate that the sort key exists in the first element of the array.
    if (!empty($input) && !array_key_exists($sortKey, $input[0])) {
        throw new InvalidArgumentException("Sort key '$sortKey' does not exist in the array elements.");
    }

    // Custom sorting logic
    $count = count($input);
    for ($i = 0; $i < $count - 1; $i++) {
        $swapped = false; // Flag to track if any elements were swapped during the pass.
        for ($j = 0; $j < $count - $i - 1; $j++) {
            $a = $input[$j][$sortKey];
            $b = $input[$j + 1][$sortKey];

            // Ensure that the values being compared are scalar types.
            if (!is_scalar($a) || !is_scalar($b)) {
                throw new InvalidArgumentException("Cannot sort by a key that is not a scalar value (like an object or array).");
            }

            if ($sortOrder->compare($a, $b) > 0) {
                [$input[$j], $input[$j + 1]] = [$input[$j + 1], $input[$j]];
                $swapped = true;
            }
        }

        // If no elements were swapped during this pass, the array is already sorted.
        if (!$swapped) {
            break;
        }
    }

    return $input;
}