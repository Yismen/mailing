<?php

namespace Dainsys\Report\Services;

use ReflectionClass;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Mail\Mailable as MailMailable;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class MailableFilesService implements ServicesContract
{
    protected static array $files;

    public static function list()
    {
        return Cache::remember('mailable_files_list', now()->addSeconds(300), function () {
            return self::getFiles();
        });
    }

    protected static function getFiles(): array
    {
        $path = app('config')['report']['mailables_dir'];
        $filesystem = new Filesystem();

        if (!$filesystem->exists($path)) {
            throw new DirectoryNotFoundException("Directory {$path} not found!");
        } else {
            foreach ($filesystem->allFiles($path) as $file) {
                $namespace = str($file->getContents())->after('namespace ')->before(';')->trim()->__toString();
                $class = "{$namespace}\\{$file->getFilenameWithoutExtension()}";
                $reflection = new ReflectionClass($class);

                if ($file->isFile() && $reflection->implementsInterface(MailMailable::class)) {
                    self::$files[] = $class;
                }
            }
        }

        return self::$files;
    }
}
