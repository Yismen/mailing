<?php

namespace Dainsys\Report\Tests\Feature\Models;

use Dainsys\Report\Tests\TestCase;
use Dainsys\Report\Models\Recipient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function recipients_model_interacts_with_db_table()
    {
        $data = Recipient::factory()->make();

        Recipient::create($data->toArray());

        $this->assertDatabaseHas(reportTableName('recipients'), $data->only([
            'name', 'email', 'title'
        ]));
    }

    /** @test */
    // public function recipients_model_has_many_employees()
    // {
    //     $recipient = Recipient::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $recipient->employees());
    // }
}
