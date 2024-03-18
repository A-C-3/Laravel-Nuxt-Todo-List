<?php

namespace App\GraphQL\Types;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TaskType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Task',
        'description' => 'A task',
        'model' => Task::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the task',
            ],
            'todo' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The todo description of the task',
            ],
            'done' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The status of the task',
            ],
        ];
    }
}
