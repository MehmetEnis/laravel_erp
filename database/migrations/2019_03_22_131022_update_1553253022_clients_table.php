<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1553253022ClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            if(Schema::hasColumn('clients', 'erp_product_id')) {
                $table->dropForeign('281134_5c94b62a59d7b');
                $table->dropIndex('281134_5c94b62a59d7b');
                $table->dropColumn('erp_product_id');
            }
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
                        
        });

    }
}
