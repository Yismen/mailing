<?php

use Dainsys\Mailing\Models\Mailable;
use Dainsys\Mailing\Models\Recipient;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailingMailableRecipientPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(mailingTableName('mailable_recipient'), function (Blueprint $table) {
            $table->foreignIdFor(Mailable::class);
            $table->foreignIdFor(Recipient::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(mailingTableName('mailable_recipient'));
    }
}
