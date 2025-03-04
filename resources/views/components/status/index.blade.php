@if (Str::of($status)->startsWith('running'))
    <x-status.running :status="$status" />
@elseif(Str::of($status)->startsWith('restarting') || Str::of($status)->startsWith('starting'))
    <x-status.restarting :status="$status" />
@else
    <x-status.stopped :status="$status" />
@endif
@if (!str($status)->contains('exited'))
    <button title="Refresh Status" wire:click='check_status(true)' class="mx-1 hover:fill-white fill-warning">
        <svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 2a10.016 10.016 0 0 0-7 2.877V3a1 1 0 1 0-2 0v4.5a1 1 0 0 0 1 1h4.5a1 1 0 0 0 0-2H6.218A7.98 7.98 0 0 1 20 12a1 1 0 0 0 2 0A10.012 10.012 0 0 0 12 2zm7.989 13.5h-4.5a1 1 0 0 0 0 2h2.293A7.98 7.98 0 0 1 4 12a1 1 0 0 0-2 0a9.986 9.986 0 0 0 16.989 7.133V21a1 1 0 0 0 2 0v-4.5a1 1 0 0 0-1-1z" />
        </svg>
    </button>
@endif
