<?php

namespace YiiContrib\Better;

use yii\db\Migration;

class MySQLMigration extends Migration
{
    /**
     * @var string The create table options.
     */
    protected $tableOptions;
    /**
     * @var bool If use transactions.
     */
    protected $useTransaction = true;
    
    public function init()
    {
        parent::init();
        
        if ($this->db->driverName === 'mysql') {
            $dbEngine = $this->useTransaction ? 'InnoDB' : 'MyISAM';
            $this->tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE={$dbEngine} AUTO_INCREMENT=10000";
        }
    }
    
    /**
     * @inheritdoc
     */
    public function createTable($table, $columns, $options = null)
    {
        parent::createTable($table, $columns, $options ?: $this->tableOptions);
    }
    
    /**
     * @param string $table
     */
    public function dropTableIfExists($table)
    {
        echo "  > drop table {$table} ...";
        $time = microtime(true);
        $table = $this->getDb()->getSchema()->quoteTableName($table);
        $this->db->createCommand("DROP TABLE IF EXISTS {$table}")->execute();
        echo ' done (time: ' . sprintf('0.3%f', microtime(true) - $time) . "s)\n";
    }
}
