<?php

namespace vahidkaargar\Tools;

class Random
{
    protected $characters = array(); // the list of characters that the string will be generated from
    public $group = array();         // the list of character groups

    // use 'default' or 0 to access default restrictions or define your own
    public $restrictions;

    /*
        @return void
    */
    public function __construct()
    {
        $this->group = [
            0 => [
                'name' => 'lowercaseletters',
                'list' => 'abcdefghijklmnopqrstuvwxyz',
                'aliases' => [
                    'lowletters',
                    'lowercase',
                    'low'
                ]
            ],

            1 => [
                'name' => 'uppercaseletters',
                'list' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                'aliases' => [
                    'upletters',
                    'uppercase',
                    'up'
                ]
            ],

            2 => [
                'name' => 'numbers',
                'list' => '0123456789',
                'aliases' => [
                    'numerals',
                    'num'
                ]
            ],

            3 => [
                'name' => 'punctuation',
                'list' => "!@#$%^&*()'",
                'aliases' => [
                    'other'
                ]
            ]
        ];
    }

    /*
    @return array characters
    */
    private function retrieve_characters($restrictions)
    {
        $characters = array();

        if (is_array($restrictions)) {
            foreach ($restrictions as $r) {
                if (is_numeric($r)) { // treated as group_id
                    foreach (str_split($this->group[$r]['list']) as $letter) {
                        $characters[] = $letter;
                    }
                } else { // treated as additional characters to add

                }
            }
        }

        return $characters;
    }

    /*
    @return string output
    */
    public function output($rules, $length)
    {
        $characters = self::retrieve_characters($rules);

        $output = '';

        for ($i = 1; $i <= $length; $i++) {
            $output .= $characters[random_int(0, count($characters) - 1)];
        }

        return $output;
    }

    /*
    @return string output
    */
    public function string($length)
    {
        $rules = [0, 1];
        $output = self::output($rules, $length);

        return $output;
    }

    public function numberString($length)
    {
        $rules = [0, 1, 2];
        $output = self::output($rules, $length);

        return $output;
    }

    /*
    @return string output
    */
    public function lowString($length)
    {
        $rules = [0];
        $output = self::output($rules, $length);

        return $output;
    }

    /*
    @return string output
    */
    public function upString($length)
    {
        $rules = [1];
        $output = self::output($rules, $length);

        return $output;
    }

    /*
    @return string output
    */
    public function numbers($length)
    {
        $rules = [2];
        $output = self::output($rules, $length);

        return $output;
    }

    /*
    @return string output
    */
    public function punctuation($length)
    {
        $rules = [3];
        $output = self::output($rules, $length);

        return $output;
    }

    /*
    @return string output
    */
    public function anyString($length)
    {
        $rules = [0, 1, 2, 3];
        $output = self::output($rules, $length);

        return $output;
    }

    /*
    @return string output
    */
    public function myString($length, $rules)
    {

    }
}
