<?php 

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\Task;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTask',
        'description' => 'Creates a new task'
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'todo' => [
                'name' => 'todo',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'string', 'max:255'],
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
        $task = new Task();
        $task->fill($args);
        $task->save();

        return $task;
    }
}
