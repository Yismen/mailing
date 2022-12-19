<?php

namespace Dainsys\Report\Services;

use ReflectionClass;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Mail\Mailable as MailMailable;

class MailableFilesService implements ServicesContract
{
    protected static array $files;

    public static function list()
    {
        $mailables = MailableService::list();

        return collect(self::getFiles())->filter(function ($value, $key) use ($mailables) {
            return $mailables->doesntContain($value);
        });
    }

    public static function count(): int
    {
        return count(MailableService::list());
    }

    protected static function getFiles(): array
    {
        $paths = app('config')->get('report.mailables_dirs');
        $filesystem = new Filesystem();
        self::$files = [];

        foreach ($paths as $path) {
            if ($filesystem->exists($path)) {
                foreach ($filesystem->allFiles($path) as $file) {
                    $namespace = str($file->getContents())->after('namespace ')->before(';')->trim()->__toString();
                    $class = "{$namespace}\\{$file->getFilenameWithoutExtension()}";
                    $reflection = new ReflectionClass($class);

                    if ($file->isFile() && $reflection->implementsInterface(MailMailable::class)) {
                        self::$files[] = $class;
                    }
                }
            }
        }

        return self::$files;
    }
}
