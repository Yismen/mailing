<?php

namespace Dainsys\Report\Tests\Feature\Models;

use Dainsys\Report\Tests\TestCase;
use Dainsys\Report\Models\Mailable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mailables_model_interacts_with_db_table()
    {
        $data = Mailable::factory()->make();

        Mailable::create($data->toArray());

        $this->assertDatabaseHas(reportTableName('mailables'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    // public function mailables_model_has_many_employees()
    // {
    //     $mailable = Mailable::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $mailable->employees());
    // }
}
