<?php

use Dainsys\Report\Models\Mailable;
use Dainsys\Report\Models\Recipient;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportMailableRecipientPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(reportTableName('mailable_recipient'), function (Blueprint $table) {
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
        Schema::dropIfExists(reportTableName('mailable_recipient'));
    }
}
