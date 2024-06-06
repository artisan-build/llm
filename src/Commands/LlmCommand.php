<?php

namespace ArtisanBuild\Llm\Commands;

use Illuminate\Console\Command;

class LlmCommand extends Command
{
    public $signature = 'llm';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
