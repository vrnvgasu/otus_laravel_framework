<?php

namespace App\Services\EducationPlans;

use App\Services\EducationPlans\Repositories\EducationPlanRepositoryInterface;
use Illuminate\Support\Collection;

class EducationPlanService
{
    /** @var  EducationPlanRepositoryInterface */
    protected $repository;

    /**
     * SubjectService constructor.
     * @param EducationPlanRepositoryInterface $repository
     */
    public function __construct(
        EducationPlanRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Вернуть учебную нагрузку по учебным планам
     * @param Collection $educationPlans
     * @return int
     */
    public function getHoursForEducationPlans(Collection $educationPlans): int
    {
        return $this->repository->getHoursForEducationPlans($educationPlans);
    }
}