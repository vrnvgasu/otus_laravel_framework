<?php

namespace App\Services\Students\Repositories;

use App\DTOs\IdDTO;
use App\DTOs\StudentDTO;
use App\DTOs\StudentFilterDTO;
use App\Models\Student;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface StudentRepositoryInterface
{
    /**
     * @param Student $student
     * @return bool
     * @throws \Exception
     */
    public function delete(Student $student): bool;

    /**
     * @param StudentDTO $studentDTO
     * @param Student $student
     * @return Student
     */
    public function update(StudentDTO $studentDTO, Student $student): Student;

    /**
     * @param StudentDTO $DTO
     * @return Student
     */
    public function store(StudentDTO $DTO): Student;

    /**
     * @param int $perPage
     * @param StudentFilterDTO $DTO
     * @return LengthAwarePaginator
     */
    public function getGroupsListPaginate(int $perPage, StudentFilterDTO $DTO): LengthAwarePaginator;

    /**
     * @param Student $student
     * @param Collection $idDTOCollection
     * @param bool $detaching
     * @return Student
     */
    public function syncWithGroups(Student $student, Collection $idDTOCollection, bool $detaching = true): Student;

    /**
     * @param StudentDTO $DTO
     * @return Student|null
     */
    public function getStudentByIdNumber(StudentDTO $DTO): ?Student;

    /**
     * @param Student $student
     * @return array
     */
    public function getStudentGroupsId(Student $student): array;
}
