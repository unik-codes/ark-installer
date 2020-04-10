<?php

namespace App\Config;

use CleaniqueCoders\LaravelUuid\Contracts\HasUuid as HasUuidContract;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class MediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        $id = $media->id;

        if ($media instanceof HasUuidContract) {
            $id = $media->getUuidColumnName();
        }

        return $media->collection_name . DIRECTORY_SEPARATOR . $id;
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media) . 'conversions' . DIRECTORY_SEPARATOR;
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsives' . DIRECTORY_SEPARATOR;
    }
}
