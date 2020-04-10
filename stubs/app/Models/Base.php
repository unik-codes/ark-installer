<?php

namespace App\Models;

use App\Traits\HasMediaExtended as MediaTrait;
use CleaniqueCoders\LaravelUuid\Contracts\HasUuid as HasUuidContract;
use CleaniqueCoders\LaravelUuid\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia as MediaContract;

class Base extends Model implements AuditableContract, HasUuidContract, MediaContract
{
    use AuditableTrait;
    use HasUuid;
    use MediaTrait;

    protected $guarded = [
        'id',
    ];
}
