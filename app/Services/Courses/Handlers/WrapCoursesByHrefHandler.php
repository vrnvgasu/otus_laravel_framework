<?php

namespace App\Services\Courses\Handlers;

use App\DTOs\WrapperDTO;
use App\Services\Helpers\TagWrapper;
use Illuminate\Support\Collection;

/**
 * Class WrapCourseCollectionByHrefHandler
 * @package App\Services\Courses\Handlers
 *
 * Оборачивает эл-ты коллекция в тег <a></a>
 */
class WrapCoursesByHrefHandler extends BaseHandler
{
    /**
     * @param Collection $courses
     * @return Collection
     */
    public function handle(Collection $courses): Collection
    {
        $courses = $courses->pluck('number', 'id');
        /**
         * TODO заменить courses на route(courses.show)
         */
        $DTO = WrapperDTO::fromArray([WrapperDTO::HREF => 'courses']);

        return TagWrapper::wrap($courses, TagWrapper::TAG_A, $DTO);
    }
}
