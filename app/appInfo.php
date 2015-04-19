<?php

return <<<EOL
<comment>Usage:</comment>
    todo [command] [content]\n
<comment>Command:</comment>
    <info>list</info>\tList all stored tasks
    <info>search</info>\t[query]\t\t Search by hash tag on tasks contents
    <info>add</info>\t\t[content]\t Add a new task
    <info>toggle</info>\t[id]\t\t Toggles task status
    <info>config</info>\t[option]\t Set configuration of app
    <info>remove</info>\t[id]\t\t Remove the task
    <info>self-update</info>\tUpdate to current version of todo app

The <info>todo</info> you can be able to manage your tasks from your terminal.\n
EOL;
