<?php

class Task
{
    public $id;
    public $description;
    public $status;
    public $createdAt;
    public $updatedAt;

    public function __construct($id, $description, $status, $createdAt, $updatedAt)
    {
        $this->id = $id;
        $this->description = $description;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}

class TaskManager
{
    private $file = 'tasks.json';
    private $tasks = [];

    public function __construct()
    {
        if (file_exists($this->file)) {
            $json = file_get_contents($this->file);
            $this->tasks = json_decode($json, true);
            $this->tasks = array_map(function ($task) {
                return new Task(...$task);
            }, $this->tasks);
        }
    }

    public function addTask($description)
    {
        $id = count($this->tasks) + 1;
        $date = date('Y-m-d H:i:s');
        $task = new Task($id, $description, 'todo', $date, $date);
        $this->tasks[] = $task;
        $this->saveTasks();

        echo "Task added successfully (ID: $id)";
    }

    public function listTasks($status = '')
    {
        if (empty($this->tasks)) {
            echo "No tasks found\n";
            return;
        }

        if ($status) {
            foreach ($this->tasks as $task) {
                if ($task->status === $status) {
                    echo $task->id . ". " . $task->description . " - " . $task->status . "\n";
                }
            }
        } else {
            foreach ($this->tasks as $task) {
                echo $task->id . ". " . $task->description . " - " . $task->status . "\n";
            }
        }
    }

    public function updateTask($id, $description)
    {
        if (empty($this->tasks)) {
            echo "No tasks found\n";
            return;
        }

        foreach ($this->tasks as $key => $task) {
            if ($task->id == $id) {
                $this->tasks[$key]->description = $description;
                $this->tasks[$key]->updatedAt = date('Y-m-d H:i:s');
                $this->saveTasks();
                break;
            }
        }
        echo "Task updated successfully";
    }

    public function markInProgress($id)
    {
        if (empty($this->tasks)) {
            echo "No tasks found\n";
            return;
        }

        foreach ($this->tasks as $key => $task) {
            if ($task->id == $id) {
                $this->tasks[$key]->status = 'in-progress';
                $this->tasks[$key]->updatedAt = date('Y-m-d H:i:s');
                $this->saveTasks();
                break;
            }
        }

        echo "Task $id marked as in progress";
    }

    public function markDone($id)
    {
        if (empty($this->tasks)) {
            echo "No tasks found\n";
            return;
        }

        foreach ($this->tasks as $key => $task) {
            if ($task->id == $id) {
                $this->tasks[$key]->status = 'done';
                $this->tasks[$key]->updatedAt = date('Y-m-d H:i:s');
                $this->saveTasks();
                break;
            }
        }

        echo "Task $id marked as done";
    }

    public function deleteTask($id)
    {
        foreach ($this->tasks as $key => $task) {
            if ($task->id == $id) {
                unset($this->tasks[$key]);
                $this->saveTasks();
                return true;
            }
        }
        echo "Task $id deleted successfully";
    }

    private function saveTasks()
    {
        $data = array_map(function ($task) {
            return [
                'id' => $task->id,
                'description' => $task->description,
                'status' => $task->status,
                'createdAt' => $task->createdAt,
                'updatedAt' => $task->updatedAt,
            ];
        }, $this->tasks);

        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->file, $json);
    }
}
