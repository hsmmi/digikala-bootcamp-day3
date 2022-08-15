<?php

#[AsMessageHandler]
class NewProductHandler
{
    public function __invoke(NewProduct $event)
    {
        echo $event->id;
    }
}