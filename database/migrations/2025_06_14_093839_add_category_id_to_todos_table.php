<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method adds the 'category_id' column to the 'todos' table.
     * It sets up a foreign key relationship with the 'categories' table.
     * 'cascadeOnDelete()' ensures that if a category is deleted, all associated todos are also deleted.
     */
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->foreignId('category_id') // Adds a BIGINT UNSIGNED column
                  ->nullable() // Makes the column optional
                  ->constrained('categories') // Adds the foreign key constraint to the 'categories' table
                  ->cascadeOnDelete(); // Deletes todos if the related category is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is executed when rolling back the migration.
     * It removes the foreign key constraint and then drops the 'category_id' column.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            // It's good practice to drop the foreign key before the column
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
