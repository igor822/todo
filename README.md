# TODO

TODO is a app to you manage tasks from your terminal.
Firstly inspired from project [Swatto/td](https://github.com/Swatto/td), a project developed in Golang.

```
Usage:
    todo [command] [content]

Command:
    list	 List all stored tasks
    add		 Add a new task
    toggle	 Toggles task status
    remove	 Remove the task
	update	 Self update todo app
```

## Usage

### Install

```bash
wget http://igor822.github.io/todo/todo.phar ~/Downloads/todo.phar
chmod +x ~/Downloads/todo.phar
sudo mv ~/Downloads/todo.phar /usr/local/bin/todo
```

After installed you can add a task to test with `add` command.

```bash
todo add 'Lorem Ipsum'
todo help
```

To list all stored tasks just type `todo`

## Directly on Dropbox

Todo stores the tasks into [Dropbox](http://dropbox.com)