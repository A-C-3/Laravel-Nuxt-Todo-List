<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use GraphQL;

class DeleteTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteTask',
        'description' => 'Deletes a task'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'exists:tasks,id'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $task = Task::findOrFail($args['id']);
        return $task->delete();
    }
}
