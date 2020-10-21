<?php
declare(strict_types=1);
namespace App\Controller;

class Gravity
{
    const VALIDCHARS = [' ','.',':','T'];

    public static function addTerrain(string $input, string $existing = null) : string
    {
        return self::drop(self::validStrToMultiArray(rtrim($input."\n".$existing,"\n\r\0\x0B")));
    }

    protected static function validStrToMultiArray(string $input, int $width = null) : array
    {
        $rows = [];
        foreach (explode("\n", $input) as $key => $line) {
            $rows[$key] = str_split(rtrim($line, "\n\r\0\x0B"));
            if ($width != null AND $width != count($rows[$key])) {
                throw new \Exception("Invalid width.");
            }
            $width = count($rows[$key]);
            $invalid = array_diff($rows[$key], self::VALIDCHARS);
            if ($invalid) {
                throw new \Exception("Invalid characters found.");
            }
        }
        return $rows;
    }

    protected static function drop(array $rows) : string
    {
        foreach ($rows as $row => $line) {
            if ($row < count($rows) - 1) {
                for ($col = 0; $col < count($line); $col++) {
                    switch ($rows[$row][$col]) {
                        case ':':
                            if ($rows[$row + 1][$col] == '.') {
                                $rows[$row + 1][$col] = ':';
                                $rows[$row][$col] = '.';
                            } elseif ($rows[$row + 1][$col] == ' ') {
                                $rows[$row + 1][$col] = ':';
                                $rows[$row][$col] = ' ';
                            }
                            break;
                        case '.':
                            if ($rows[$row + 1][$col] == '.') {
                                $rows[$row + 1][$col] = ':';
                                $rows[$row][$col] = ' ';
                            } elseif ($rows[$row + 1][$col] == ' ') {
                                $rows[$row + 1][$col] = '.';
                                $rows[$row][$col] = ' ';
                            }
                            break;
                    }
                }
            }
        }
        $output = '';
        foreach ($rows as $k => $row) {
            if ($k > 0) $output .= PHP_EOL;
            $output .= implode('', $row);
        }
        return $output;
    }
}