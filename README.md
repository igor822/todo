# Todo list

TODO is a app to you manage tasks from your terminal.
Firstly inspired from project [Swatto/td](https://github.com/Swatto/td), a project developed in Golang.

```bash
Usage:
    todo [command] [content]

Command:
    list	    List all stored tasks
    filter      [--done]        Filter all finished tasks
    config      [option]	    Set configuration of app
    search      [query]         Search by hash tag on tasks contents
    add         [content]       Add a new task
    update      [id] [value]	Update a task
    toggle      [id]		    Toggles task status
    remove      [id]		    Remove the task
    self-update Update to current version of todo app

```

## Usage

### Install

```bash
wget http://igor822.github.io/todo/todo.phar ~/Downloads/todo.phar
chmod +x ~/Downloads/todo.phar
sudo mv ~/Downloads/todo.phar /usr/local/bin/todo
```

To configure the `todo` storage path just run:

```bash
todo init
# put the full path where of storage
```

Or

```bash
todo config --file-storage="/path/to/storage.todo"
```

After configurated you can add a task to test with `add` command.

```bash
todo add 'Lorem Ipsum'
todo help
```

To list all **open** tasks just type `todo`
