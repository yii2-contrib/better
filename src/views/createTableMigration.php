<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */
/* @var $table string the name table */
/* @var $fields array the fields */
/* @var $foreignKeys array the foreign keys */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use YiiContrib\Better\MySQLMigration;

/**
 * Handles the creation of table `<?= $table ?>`.
<?= $this->render('@yii/views/_foreignTables', [
    'foreignKeys' => $foreignKeys,
]) ?>
 */
class <?= $className ?> extends MySQLMigration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
    <?= $this->render('@yii/views/_createTable', [
        'table' => $table,
        'fields' => $fields,
        'foreignKeys' => $foreignKeys,
    ])
    ?>
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
    <?= $this->render('@yii/views/_dropTable', [
        'table' => $table,
        'foreignKeys' => $foreignKeys,
    ])
    ?>
    }
}
