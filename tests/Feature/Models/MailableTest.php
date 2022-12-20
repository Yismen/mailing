<?php

namespace Dainsys\Mailing\Tests\Feature\Models;

use Dainsys\Mailing\Tests\TestCase;
use Dainsys\Mailing\Models\Mailable;
use Dainsys\Mailing\Models\Recipient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mailables_model_interacts_with_db_table()
    {
        $data = Mailable::factory()->make();

        Mailable::create($data->toArray());

        $this->assertDatabaseHas(mailingTableName('mailables'), $data->only([
            'name', 'description', 'active'
        ]));
    }

    /** @test */
    public function mailables_model_belongs_to_many_recipients()
    {
        $mailable = Mailable::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $mailable->recipients());
    }

    /** @test */
    public function mailables_model_sync_recipients()
    {
        $mailable = Mailable::factory()->create();
        $recipient = Recipient::factory()->create();

        $mailable->recipients()->sync([$recipient->id]);

        $this->assertDatabaseHas(mailingTableName('mailable_recipient'), ['mailable_id' => $mailable->id, 'recipient_id' => $recipient->id]);
    }
}
