<?php

namespace Kata\Shared\Domain;

abstract class DomainCollection
{
    private $items;

    public function __construct(array $items)
    {
        Assert::arrayOf($this->getType(), $items);

        $this->items = $items;
    }

    abstract protected function getType();

    public function getItems(): array
    {
        return $this->items;
    }

    public function pushItem($item): void
    {
        Assert::instanceOf($this->getType(), $item);

        $this->items[] = $item;
    }
}