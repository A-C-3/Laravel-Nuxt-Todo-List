<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTask',
        'description' => 'Updates an existing task'
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'exists:tasks,id'],
            ],
            'todo' => [
                'name' => 'todo',
                'type' => Type::string(),
                'rules' => ['string', 'max:255'],
            ],
            'done' => [
                'name' => 'done',
                'type' => Type::boolean(),
                'rules' => ['boolean'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $task = Task::findOrFail($args['id']);
        $task->fill($args);
        $task->save();

        return $task;
    }
}
