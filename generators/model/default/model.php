<?php
/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator mirkhamidov\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $properties array list of properties (property => [type, name. comment]) */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
$_createdAt = $_updatedAt = false;

if (isset($properties['created_at'])) {
    $_createdAt = true;
}
if (isset($properties['updated_at'])) {
    $_updatedAt = true;
}
?>

namespace <?= $generator->ns ?>;

use Yii;
<?php if ($_createdAt || $_updatedAt) : ?>
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
<?php endif; ?>

/**
 *
 *
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseNs, '\\') . "\\$className\n" ?>
{
<?php if ($_createdAt || $_updatedAt) : ?>
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class ,
                'value' => new Expression('NOW()'),
<?php if (!$_createdAt) : ?>
                'createdAtAttribute' => false,
<?php endif ?>
<?php if (!$_updatedAt) : ?>
                'updatedAtAttribute' => false,
<?php endif ?>
            ],
        ];
    }
    
<?php endif; ?>
<?php foreach ($relations as $name => $relation): ?>

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get<?= $name ?>()
    {
        <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>

}
