<?php

namespace Dainsys\Mailing\Tests\Unit;

use Dainsys\Mailing\Mailing;
use Dainsys\Mailing\Tests\TestCase;
use Dainsys\Mailing\Models\Mailable;
use Dainsys\Mailing\Models\Recipient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_binds_path_to_config()
    {
        config()->set('mailing.mailables_dirs', ['foo']);

        Mailing::bind('bar');

        $this->assertEquals(['bar', 'foo'], config('mailing.mailables_dirs'));
    }

    /** @test */
    public function it_binds_super_users_to_config()
    {
        config()->set('mailing.super_users', 'foo');

        Mailing::registerSuperUsers(['another@user.com']);

        $this->assertEquals('foo,another@user.com', config('mailing.super_users'));
    }
}
