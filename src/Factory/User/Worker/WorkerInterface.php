<?php



namespace App\Factory\User\Worker;

interface WorkerInterface extends IndexInterface, PriorityInterface, SupportsInterface, InvokeInterface
{
}
