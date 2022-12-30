<?php

namespace Dainsys\Mailing\Tests\Unit;

use Dainsys\Mailing\Mailing;
use Dainsys\Mailing\Tests\TestCase;
use Dainsys\Mailing\Models\Mailable;
use Dainsys\Mailing\Models\Recipient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\Mailing\Exceptions\MailableNotFoundException;
use Dainsys\Mailing\Exceptions\MailableNotActiveException;
use Dainsys\Mailing\Exceptions\MailableWithoutRecipientsException;

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

    /** @test */
    public function it_throws_mailable_not_found_exception_if_mailable_is_not_stored_on_database()
    {
        $this->expectException(MailableNotFoundException::class);

        // $mailable = Mailable::factory()->active()->create(['name' => 'SomeNameMail']);

        Mailing::recipients('SomeNameMail');
    }

    /** @test */
    public function it_throws_mailable_not_active_exception_if_mailable_is_not_active()
    {
        $this->expectException(MailableNotActiveException::class);

        Mailable::factory()->inactive()->create(['name' => 'SomeNameMail']);

        Mailing::recipients('SomeNameMail');
    }


    /** @test */
    public function it_throws_mailable_without_recipients_exception_if_mailable_has_no_recipients_assigned()
    {
        $this->expectException(MailableWithoutRecipientsException::class);

        Mailable::factory()->active()->create(['name' => 'SomeNameMail']);

        Mailing::recipients('SomeNameMail');
    }

    /** @test */
    public function it_returns_an_array_with_recipients_assigned_to_mailable()
    {
        $mailable = Mailable::factory()->active()->create(['name' => 'SomeNameMail']);
        $recipient = Recipient::factory()->create();
        $mailable->recipients()->sync([$recipient->id]);

        $this->assertEquals([$recipient->name => $recipient->email], Mailing::recipients('SomeNameMail'));
    }
}
