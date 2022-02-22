<?php

namespace Elshaden\LivewireUsersystem\Commands;

use Illuminate\Console\Command;

class LivewireUsersystemCommand extends Command
{
    public $signature = 'livewire-usersystem';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
