<?php

namespace ArtisanBuild\Llm\Traits;

trait HasLifecycleHooks
{
    protected array $hooks = [
        'on_before_prompt' => null,
        'on_after_prompt' => null,
    ];

    public function onBeforePrompt(callable $callback): self
    {
        $this->hooks['on_before_prompt'] = $callback;

        return $this;
    }

    public function onAfterPrompt(callable $callback): self
    {
        $this->hooks['on_after_prompt'] = $callback;

        return $this;
    }

    protected function runHook(string $hook): void
    {
        if (is_callable($this->hooks[$hook])) {
            $this->hooks[$hook]($this);
        }
    }
}
