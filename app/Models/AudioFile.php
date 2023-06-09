<?php

namespace App\Models;

class AudioFile
{

    public function __construct(
        public readonly string $path,
    ) {}

    public function fullPath(): string
    {
        return storage_path("app/{$this->path}");
    }

    public function dir(): string
    {
        return dirname($this->path);
    }

    public function name(): string
    {
        return basename($this->path);
    }

    public function derive(string $suffix, string $extension = null): AudioFile
    {
        return new static(
            dirname($this->path) . DIRECTORY_SEPARATOR . $this->derivedName($suffix, $extension)
        );
    }

    public function derivedName(string $suffix, string $extension = null): string
    {
        $info = new \SplFileInfo($this->path);

        $ext = $info->getExtension();
        $basename = $info->getBasename(".$ext");

        if ($extension) {
            $ext = $extension;
        }

        return "{$basename}-{$suffix}.$ext";
    }

    public function exists(): bool
    {
        return file_exists($this->fullPath());
    }

    /**
     * @return false|resource
     */
    public function read()
    {
        return fopen($this->fullPath(), 'rb');
    }

    /**
     * @return false|resource
     */
    public function write()
    {
        return fopen($this->fullPath(), 'wb');
    }

    public function delete(): bool
    {
        $path = $this->fullPath();

        if (file_exists($path)) {
            return unlink($this->fullPath());
        }

        return true;
    }

}
