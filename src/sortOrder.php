<?php

/**
 * Enum SortOrder
 *
 * This enum represents the different sorting orders that can be applied
 * to an array of data. Each enum case corresponds to a specific comparison
 * method, including case-sensitive, case-insensitive, and natural order comparisons.
 */
enum SortOrder: string {
    case ASC = 'asc';
    case DESC = 'desc';
    case CASE_INSENSITIVE_ASC = 'case_insensitive_asc';
    case CASE_INSENSITIVE_DESC = 'case_insensitive_desc';
    case NATURAL_ASC = 'natural_asc';
    case NATURAL_DESC = 'natural_desc';

    /**
     * Compare two values based on the sorting order.
     *
     * @param mixed $a The first value to compare.
     * @param mixed $b The second value to compare.
     * @return int Returns < 0 if $a is less than $b, > 0 if $a is greater than $b, and 0 if they are equal.
     * @throws InvalidArgumentException If the comparison method is not supported.
     */
    public function compare($a, $b): int {
        return match($this) {
            self::ASC                   => $a <=> $b,
            self::DESC                  => $b <=> $a,
            self::CASE_INSENSITIVE_ASC  => (strcasecmp($a, $b) !== 0) ? strcasecmp($a, $b) : strcmp($a, $b),
            self::CASE_INSENSITIVE_DESC => (strcasecmp($a, $b) !== 0) ? strcasecmp($b, $a) : strcmp($b, $a),
            self::NATURAL_ASC           => strnatcmp((string) $a, (string) $b),
            self::NATURAL_DESC          => strnatcmp((string) $b, (string) $a),
        };
    }

    /**
     * Convert a string to a corresponding SortOrder enum case.
     *
     * @param string $sortOrder The sort order as a string.
     * @return SortOrder The corresponding SortOrder enum case.
     * @throws InvalidArgumentException If the provided string does not match any known sort order.
     */
    public static function fromString(string $sortOrder): self {
        return match(strtolower($sortOrder)) {
            'asc'                   => self::ASC,
            'desc'                  => self::DESC,
            'case_insensitive_asc'  => self::CASE_INSENSITIVE_ASC,
            'case_insensitive_desc' => self::CASE_INSENSITIVE_DESC,
            'natural_asc'           => self::NATURAL_ASC,
            'natural_desc'          => self::NATURAL_DESC,
            default                 => throw new InvalidArgumentException("Invalid sort order: $sortOrder"),
        };
    }
}
