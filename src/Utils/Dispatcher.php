<?php


namespace Joehoel\MediaBlurhash\Utils;

use Joehoel\MediaBlurhash\BlurhashMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Dispatcher
 *
 * Dispatches the Blurhash job, optionally using a custom connection and/or queue
 * name.
 *
 * @package Joehoel\MediaBlurhash\Utils
 */
class Dispatcher
{
    /**
     * @var Media
     */
    protected $media;

    /**
     * Dispatcher constructor.
     * @param Media $media
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    /**
     * Dispatch the job.
     */
    public function run()
    {
        if(empty(config('media-blurhash.queue.name'))){
            BlurhashMedia::dispatch($this->media)
                ->onConnection(config('media-blurhash.queue.connection', config('queue.default')));
        } else {
            BlurhashMedia::dispatch($this->media)
                ->onQueue('media-blurhash.queue.name')
                ->onConnection(config('media-blurhash.queue.connection', config('queue.default')));
        }
    }
}
