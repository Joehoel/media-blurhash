<?php

namespace Joehoel\MediaBlurhash;

use Joehoel\MediaBlurhash\Utils\Dispatcher;
use Joehoel\MediaBlurhash\Utils\ImageChecker;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

/**
 * Class MediaBlurhashListener
 * @package Joehoel\MediaBlurhash
 */
class MediaBlurhashListener
{
    /**
     * Handle the event.
     */
    public function handle(MediaHasBeenAddedEvent $event): void
    {
        if((new ImageChecker($event->media))->isImage()){
            (new Dispatcher($event->media))->run();
        }
    }

}
