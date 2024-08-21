<?php

require_once __DIR__ . '/../src/customSort.php';

function testCustomSort() {
    // Test Case 1: Ascending sort by age
    $input = [
        ['name' => 'Alice', 'age' => 24],
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'Charlie', 'age' => 23]
    ];

    $expectedAsc = [
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'Charlie', 'age' => 23],
        ['name' => 'Alice', 'age' => 24]
    ];

    $resultAsc = customSort($input, 'age', 'asc');
    assert($resultAsc === $expectedAsc, 'Test failed for ascending order by age.');

    // Test Case 2: Descending sort by age
    $expectedDesc = [
        ['name' => 'Alice', 'age' => 24],
        ['name' => 'Charlie', 'age' => 23],
        ['name' => 'Bob', 'age' => 21]
    ];

    $resultDesc = customSort($input, 'age', 'desc');
    assert($resultDesc === $expectedDesc, 'Test failed for descending order by age.');

    // Test Case 3: Ascending sort by name
    $expectedNameAsc = [
        ['name' => 'Alice', 'age' => 24],
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'Charlie', 'age' => 23]
    ];

    $resultNameAsc = customSort($input, 'name', 'asc');
    assert($resultNameAsc === $expectedNameAsc, 'Test failed for ascending order by name.');

    // Test Case 4: Descending sort by name
    $expectedNameDesc = [
        ['name' => 'Charlie', 'age' => 23],
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'Alice', 'age' => 24]
    ];

    $resultNameDesc = customSort($input, 'name', 'desc');
    assert($resultNameDesc === $expectedNameDesc, 'Test failed for descending order by name.');

    // Test Case 5: Empty array
    $inputEmpty = [];
    $resultEmpty = customSort($inputEmpty, 'name', 'asc');
    assert($resultEmpty === [], 'Test failed for empty array.');

    // Test Case 6: Array with identical keys
    $inputIdentical = [
        ['name' => 'Alice', 'age' => 24],
        ['name' => 'Alice', 'age' => 21],
        ['name' => 'Alice', 'age' => 23]
    ];

    $expectedIdenticalAsc = [
        ['name' => 'Alice', 'age' => 21],
        ['name' => 'Alice', 'age' => 23],
        ['name' => 'Alice', 'age' => 24]
    ];

    $resultIdenticalAsc = customSort($inputIdentical, 'age', 'asc');
    assert($resultIdenticalAsc === $expectedIdenticalAsc, 'Test failed for identical names, ascending order by age.');

    // Test Case 7: Non-existing sort key
    try {
        customSort($input, 'nokey', 'asc');
        assert(false, 'Test failed to throw an exception for non-existing sort key.');
    } catch (InvalidArgumentException $e) {
        assert($e->getMessage() === "Sort key 'nokey' does not exist in the array elements.", 
        'Test failed with incorrect exception message for non-existing sort key.');
    }

    // Test Case 8: Invalid sort order
    try {
        customSort($input, 'age', 'invalid_order');
        assert(false, 'Test failed to throw an exception for invalid sort order.');
    } catch (InvalidArgumentException $e) {
        assert($e->getMessage() === "Invalid sort order: invalid_order", 
        'Test failed with incorrect exception message for invalid sort order.');
    }

    // Test Case 9: Mixed Data Type
    $inputMixed = [
        ['name' => 'Alice', 'age' => '24'],
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'Charlie', 'age' => '23']
    ];

    $expectedMixedAsc = [
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'Charlie', 'age' => '23'],
        ['name' => 'Alice', 'age' => '24']
    ];

    $resultMixedAsc = customSort($inputMixed, 'age', 'asc');
    assert($resultMixedAsc === $expectedMixedAsc, 'Test failed for mixed data types (strings and integers) sorted by age in ascending order.');

    // Test Case 10: Sorting by a key that is an object
    $inputWithObjects = [
        ['name' => 'Alice', 'data' => (object)['age' => 24]],
        ['name' => 'Bob', 'data' => (object)['age' => 21]],
        ['name' => 'Charlie', 'data' => (object)['age' => 23]]
    ];

    try {
        customSort($inputWithObjects, 'data', 'asc');
        assert(false, 'Test failed to throw an exception when sorting by an object.');
    } catch (InvalidArgumentException $e) {
        assert($e->getMessage() === "Cannot sort by a key that is not a scalar value (like an object or array).", 
            'Test failed with incorrect exception message when sorting by an object.');
    }

    // New Test Case 11: Case-insensitive ascending sort by name
    $inputCaseInsensitive = [
        ['name' => 'alice', 'age' => 24],
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'Charlie', 'age' => 23],
        ['name' => 'bob', 'age' => 30]
    ];

    $expectedCaseInsensitiveAsc = [
        ['name' => 'alice', 'age' => 24],
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'bob', 'age' => 30],
        ['name' => 'Charlie', 'age' => 23]
    ];

    $resultCaseInsensitiveAsc = customSort($inputCaseInsensitive, 'name', 'case_insensitive_asc');
    assert($resultCaseInsensitiveAsc === $expectedCaseInsensitiveAsc, 'Test failed for case-insensitive ascending order by name.');

    // New Test Case 12: Case-insensitive descending sort by name
    $expectedCaseInsensitiveDesc = [
        ['name' => 'Charlie', 'age' => 23],
        ['name' => 'bob', 'age' => 30],
        ['name' => 'Bob', 'age' => 21],
        ['name' => 'alice', 'age' => 24]
    ];

    $resultCaseInsensitiveDesc = customSort($inputCaseInsensitive, 'name', 'case_insensitive_desc');
    assert($resultCaseInsensitiveDesc === $expectedCaseInsensitiveDesc, 'Test failed for case-insensitive descending order by name.');

    // New Test Case 13: Natural ascending sort by name
    $inputNatural = [
        ['name' => 'item10', 'age' => 24],
        ['name' => 'item2', 'age' => 21],
        ['name' => 'item1', 'age' => 23]
    ];

    $expectedNaturalAsc = [
        ['name' => 'item1', 'age' => 23],
        ['name' => 'item2', 'age' => 21],
        ['name' => 'item10', 'age' => 24]
    ];

    $resultNaturalAsc = customSort($inputNatural, 'name', 'natural_asc');
    assert($resultNaturalAsc === $expectedNaturalAsc, 'Test failed for natural ascending order by name.');

    // New Test Case 14: Natural descending sort by name
    $expectedNaturalDesc = [
        ['name' => 'item10', 'age' => 24],
        ['name' => 'item2', 'age' => 21],
        ['name' => 'item1', 'age' => 23]
    ];

    $resultNaturalDesc = customSort($inputNatural, 'name', 'natural_desc');
    assert($resultNaturalDesc === $expectedNaturalDesc, 'Test failed for natural descending order by name.');

    echo "All tests passed.\n";
}

testCustomSort();