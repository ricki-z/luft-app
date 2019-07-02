<?php declare(strict_types=1);

namespace App\Pollution\DataPersister;

use App\Entity\Data;
use App\Pollution\Value\Value;

class Persister extends AbstractPersister
{
    public function persistValues(array $values): PersisterInterface
    {
        if (0 === count($values)) {
            return $this;
        }

        $this->uniqueStrategy->init($values);

        /** @var Value $value */
        foreach ($values as $value) {
            $data = new Data();

            $data
                ->setDateTime($value->getDateTime())
                ->setValue($value->getValue())
                ->setPollutant($value->getPollutant());

            if ($this->stationExists($value->getStation())) {
                $data->setStation($this->getStationByCode($value->getStation()));
            } else {
                continue;
            }

            if ($this->uniqueStrategy->isDataDuplicate($data)) {
                continue;
            }

            $this->uniqueStrategy->addData($data);

            $this->entityManager->persist($data);

            $this->newValueList[] = $data;
        }

        $this->entityManager->flush();

        $this->uniqueStrategy->save();

        return $this;
    }
}
