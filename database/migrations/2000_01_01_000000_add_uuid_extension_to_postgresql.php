<?php

use Illuminate\Database\Migrations\Migration;

class AddUuidExtensionToPostgresql extends Migration
{
    public function up(): void
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
    }
}
