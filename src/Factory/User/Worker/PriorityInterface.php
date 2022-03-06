<?php



namespace App\Factory\User\Worker;

interface PriorityInterface
{
    public static function getPriority(): int;
}
