<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommonFieldsToMultipleTables extends Migration
{
    // Daftar kolom yang ingin ditambahkan
    protected $columnsToAdd = [
        'CompanyCode' => ['type' => 'string', 'length' => 20, 'nullable' => true],
        'Status' => ['type' => 'tinyInteger', 'default' => 1],
        'IsDeleted' => ['type' => 'tinyInteger', 'default' => 0],
        'CreatedBy' => ['type' => 'string', 'length' => 32, 'nullable' => true],
        'CreatedDate' => ['type' => 'dateTime', 'default' => 'CURRENT_TIMESTAMP'],
        'LastUpdatedBy' => ['type' => 'string', 'length' => 32, 'nullable' => true],
        'LastUpdatedDate' => ['type' => 'dateTime', 'nullable' => true],
    ];

    // Daftar tabel yang akan diperiksa
    protected $tables = [
        'detpesanans',
        'failed_jobs',
        'invoices',
        'kabupatens',
        'kecamatans',
        'migrations',
        'eongkirs',
        'password_resets',
        'pengirimans',
        'personal_access_tokens',
        'pesanans',
        'produks',
        'views',
        'stores'
    ];

    public function up()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $tableBlueprint) use ($table) {
                foreach ($this->columnsToAdd as $column => $definition) {
                    if (!Schema::hasColumn($table, $column)) {
                        $columnType = $definition['type'];
                        $columnDef = $tableBlueprint->$columnType($column, $definition['length'] ?? null);

                        if (!empty($definition['nullable'])) {
                            $columnDef->nullable();
                        }

                        if (!empty($definition['default'])) {
                            if ($definition['default'] === 'CURRENT_TIMESTAMP') {
                                $columnDef->useCurrent();
                            } else {
                                $columnDef->default($definition['default']);
                            }
                        }
                    }
                }
            });
        }
    }

    public function down()
    {
        // Optional: untuk rollback, bisa diisi kalau mau
    }
}
