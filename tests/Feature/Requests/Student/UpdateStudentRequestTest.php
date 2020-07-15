<?php

namespace Tests\Feature\Requests\Student;

use App\Http\Controllers\Students\Requests\UpdateStudentRequest;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\Services\Students\StudentService;
use App\Services\Users\UserService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Validator;
use Tests\Feature\Requests\RequestTrait;
use Tests\TestCase;

/**
 * Class UpdateStudentRequestTest
 * @package Tests\Feature\Requests\Student
 * @group student
 */
class UpdateStudentRequestTest extends TestCase
{
    use RefreshDatabase;
    use RequestTrait;

    /** @var UpdateStudentRequest */
    private $rules;
    /** @var Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');
        $this->rules = (new UpdateStudentRequest())->rules();
    }

    public function validationProvider(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            'request_should_fail_when_no_last_name_is_provided' => [
                'passed' => true,
                'data' => [
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_last_name_is_not_sting' => [
                'passed' => false,
                'data' => [
                    'last_name' => rand(),
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_last_name_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->paragraph(30),
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],

            'request_should_fail_when_no_name_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_name_is_not_sting' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => rand(),
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_name_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->paragraph(30),
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],

            'request_should_fail_when_no_second_name_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_second_name_is_not_sting' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => rand(),
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_second_name_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->paragraph(30),
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],

            'request_should_fail_when_no_group_id_is_provided' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_group_id_is_not_an_array' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => 'test',
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_group_id_is_empty' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
            'request_should_fail_when_group_id_has_not_integer' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => ['test'],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],

            'request_should_fail_when_no_id_number_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                ],
            ],
            'request_should_pass_when_id_number_is_not_integer' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => 'test',
                ],
            ],
            'request_should_pass_when_id_number_is_0' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => 0,
                ],
            ],
            'request_should_pass_when_id_number_is_to_long' => [
                'passed' => false,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => 999999999999999990,
                ],
            ],

            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'last_name' => $faker->lastName,
                    'name' => $faker->firstName,
                    'second_name' => $faker->firstName,
                    'group_id' => [rand(),rand()],
                    'id_number' => rand(1, 99999999999999999),
                ],
            ],
        ];
    }

    /**
     * @group 1
     */
    public function testUniqueIdNumber(): void
    {
        $this->seed(\RoleSeeder::class);
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        /**
         * Номер студенческого билета совпадает с номером обновляемого пользователя
         */
        $selfIdNumber = 12;
        $student = factory(Student::class)->create(
            [
                'id_number' => $selfIdNumber,
                'user_id' => ($user = factory(User::class)->create([
                    'role_id' => Role::ADMIN,
                ])),
            ]
        );
        $this->partialMock(UserService::class, function ($mock) use ($user) {
            $mock->shouldReceive('update')->once()
            ->andReturn($user);
        });
        $this->mock(StudentService::class, function ($mock) {
            $mock->shouldReceive('update')->once();
        });

        $this->actingAs($user)->put(route('students.update', $student), [
            'last_name' => $faker->firstName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'group_id' => [rand(),rand()],
            'id_number' => $selfIdNumber,
        ])->assertSessionHasNoErrors();
        \Mockery::close();

        /**
         * Номер студенческого билета совпадает с номером другого студента
         */
        $someIdNumber = 15;
        factory(Student::class)->create(
            [
                'id_number' => $someIdNumber,
                'user_id' => (factory(User::class)->create([
                    'role_id' => Role::STUDENT,
                ])),
            ]
        );
        $this->actingAs($user)->put(route('students.update', $student->id), [
            'last_name' => $faker->firstName,
            'name' => $faker->firstName,
            'second_name' => $faker->firstName,
            'group_id' => [rand(),rand()],
            'id_number' => $someIdNumber,
        ])->assertSessionHasErrors();
    }
}