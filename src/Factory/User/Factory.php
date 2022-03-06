<?php



namespace App\Factory\User;

use App\Factory\User\Worker\AbstractWorker;
use App\Factory\User\Worker\WorkerInterface;
use Traversable;

class Factory
{
    /**
     * @var WorkerInterface[] | null
     */
    protected $workers;

    public function setWorkers(iterable $workers): self
    {
        $this->workers = $workers instanceof Traversable ? iterator_to_array($workers) : $workers;

        if (!is_array($this->workers)) {
            $this->workers = [];
        }

        return $this;
    }

    /**
     * @return WorkerInterface[]
     */
    public function run(string $fileName): array
    {
        $workers = [];
        $workerKeys = array_keys($this->workers);
        for ($workerIndex = 0; $workerIndex < count($this->workers); ++$workerIndex) {
            $worker = $this->workers[$workerKeys[$workerIndex]];
            if (!$worker instanceof AbstractWorker) {
                continue;
            }
            if ($worker->supports()) {
                $workers[$workerKeys[$workerIndex]] = $worker($fileName);
            }
        }

        return $workers;
    }
}
