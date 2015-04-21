<?php

namespace Task\Action;

use Task\Component\ConsoleColor;
use Task\Constants\StatusType;
use Task\Constants\UnicodeIcon;

class ListAction extends AbstractAction
{
    private $items = [];

    private $itemsSearch = [];

    public function search($query)
    {
        $content = $this->run();
        foreach ($content as $index => $item) {
            $this->searchContent($index, $item, $query);
        }

        return $this->itemsSearch;
    }

    private function searchContent($index, $item, $search)
    {
        if (strpos($item['content'], '#' . $search) !== false) {
            $this->itemsSearch[$index] = $item;
        }
    }

    public function run()
    {
        $storageAdapter = $this->getStorage()->getAdapter();
        $this->items = $storageAdapter->findAll();
        return $this->items;
    }

    private function printHashTag($content)
    {
        preg_match_all("/((?<=([#]))[A-Za-z0-9]+)/", $content, $matches, PREG_PATTERN_ORDER);
        foreach ($matches[0] as $match) {
            $search = '#' . $match;
            $replace = ConsoleColor::printColor($search, 'light_yellow');
            $content = str_replace($search, $replace, $content);
        }

        return $content;
    }

    private function filterByStatus($items, $status)
    {
        $itemsAux = [];
        foreach ($items as $item) {
            if ($item['status'] == $status) {
                $itemsAux[] = $item;
            }
        }
        return $itemsAux;
    }

    public function printAllTasks($query = null, $filter = StatusType::TODO)
    {
        $iconStatus = function($status) {
            $str = '';
            $color = '';
            switch ($status) {
                case StatusType::TODO:
                    $str = UnicodeIcon::OPEN;
                    $color = 'red';
                    break;
                case StatusType::DONE:
                    $str = UnicodeIcon::CLOSED;
                    $color = 'green';
                    break;
            }

            return ConsoleColor::printColor(json_decode('"' . $str . '"'), $color);
        };

        $items = $this->run();
        if ($query !== null) {
            $items = $this->search($query);
        }
        $items = $this->filterByStatus($items, $filter);
        $lines = [];
        foreach ($items as $item) {
            $lines[] = sprintf(
                "%s | %s | %s",
                $item['id'],
                $iconStatus($item['status']),
                $this->printHashTag($item['content'])
            );
        }

        return $lines;
    }

    public function hasTask()
    {
        return count($this->items) > 0 ? true : false;
    }
}
