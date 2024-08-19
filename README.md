# Simple Task Manager

This is a simple command-line task manager application written in PHP. It allows you to add, list, update, mark as in-progress/done, and delete tasks.

## Installation

There are no external dependencies to install. Just save the files `index.php` and `TaskManager.php` in the same directory.

## Usage

### 1. Running the application:

Open your terminal and navigate to the directory where you saved the files. Then, run the following command:

```bash
php index.php <command> <arguments>
```

### 2. **Commands**:

- **`add <description>`** : Adds a new task with the specified description.
- **`list [status]`** : Lists all tasks. Optionally, filter by status (`todo`, `in-progress`, `done`).
- **`update <id> <description>`** : Updates the description of a task by its ID.
- **`mark-in-progress <id>`** : Marks a task as in progress.
- **`mark-done <id>`** : Marks a task as done.
- **`delete <id>`** : Deletes a task.

### 3. **Examples**:

- Add a new task:

```bash
php index.php add "Buy groceries"
```

- List all tasks:

```bash
php index.php list
```

- List only tasks in progress:

```bash
php index.php list in-progress
```

- Update the description of task with ID 2:

```bash
php index.php update 2 "Finish homework"
```

- Mark task with ID 1 as in progress:

```bash
php index.php mark-in-progress 1
```

- Delete task with ID 3:

```bash
php index.php delete 3
```

### 4. Output:

The application will print messages to the console depending on the command and its success.

### 5. Note:

Tasks are stored in a JSON file (tasks.json).
The application does not handle invalid commands or arguments.
