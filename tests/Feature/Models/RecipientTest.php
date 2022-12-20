<?php

namespace Dainsys\Mailing\Tests\Feature\Models;

use Dainsys\Mailing\Tests\TestCase;
use Dainsys\Mailing\Models\Mailable;
use Dainsys\Mailing\Models\Recipient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function recipients_model_interacts_with_db_table()
    {
        $data = Recipient::factory()->make();

        Recipient::create($data->toArray());

        $this->assertDatabaseHas(mailingTableName('recipients'), $data->only([
            'name', 'email', 'title'
        ]));
    }

    /** @test */
    public function recipients_model_belongs_to_many_mailables()
    {
        $recipient = Recipient::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $recipient->mailables());
    }

    /** @test */
    public function recipients_model_sync_mailables()
    {
        $recipient = Recipient::factory()->create();
        $mailable = Mailable::factory()->create();

        $recipient->mailables()->sync([$mailable->id]);

        $this->assertDatabaseHas(mailingTableName('mailable_recipient'), ['mailable_id' => $mailable->id, 'recipient_id' => $recipient->id]);
    }
}
