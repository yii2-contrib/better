<?php

namespace YiiContrib\Better;

use yii\console\controllers\MigrateController;

/**
 * Class MySQLMigrateController
 *
 * @package YiiContrib\Better
 */
final class MySQLMigrateController extends MigrateController
{
    /**
     * @var string The table prefix
     */
    public $tablePrefix = '';
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->templateFile = __DIR__ . '/views/migration.php';
        $this->generatorTemplateFiles['create_table'] = __DIR__ . '/views/createTableMigration.php';
    }
    
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $result = parent::beforeAction($action);
        
        $this->db->tablePrefix = $this->tablePrefix;
        
        return $result;
    }
}
