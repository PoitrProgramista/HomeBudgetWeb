<?php

class ValidityTools
{
    static function isCurrency($amount)
    {
        return preg_match("/^[0-9]+(?:\.[0-9]{1,2})?$/", $amount);
    }

    static function validateDate($date)
    {
        $format = 'Y-m-d';
        $dateOut = DateTime::createFromFormat($format, $date);

        return $dateOut && $dateOut->format($format) == $date;
    }

    static function validatePeriod($begin, $end)
    {
        return $end >= $begin;
    }
}