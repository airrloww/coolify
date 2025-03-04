<?php

namespace App\Actions\Database;

use App\Events\DatabaseStatusChanged;
use App\Models\StandaloneMariadb;
use App\Models\StandaloneMongodb;
use App\Models\StandaloneMysql;
use App\Models\StandalonePostgresql;
use App\Models\StandaloneRedis;
use Lorisleiva\Actions\Concerns\AsAction;

class StopDatabase
{
    use AsAction;

    public function handle(StandaloneRedis|StandalonePostgresql|StandaloneMongodb|StandaloneMysql|StandaloneMariadb $database)
    {
        $server = $database->destination->server;
        instant_remote_process(
            ["docker rm -f {$database->uuid}"],
            $server
        );
        if ($database->is_public) {
            StopDatabaseProxy::run($database);
        }
        // TODO: make notification for services
        // $database->environment->project->team->notify(new StatusChanged($database));
    }
}
