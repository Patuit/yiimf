<?php

use app\models\Authors;
use app\models\MagazinsAuthors;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$form = ActiveForm::begin([
    'id' => 'form-input-example',
    'options' => [
        'class' => 'form-horizontal col-lg-11',
        'enctype' => 'multipart/form-data'
    ],
]);
?>

<?php echo $form->field($model, 'title')->textInput()->label('Название'); ?>
<?php echo $form->field($model, 'description')->textInput()->label('Описание'); ?>
<?php echo $form->field($imageModel, 'image')->fileInput()->label('Изображение'); ?>
<?php
if ($authors)
    $authors->id = $authorsArray;
echo
$form
    ->field($authors, 'id')
    ->listBox(
        \yii\helpers\ArrayHelper::map(Authors::find()->all(), 'id', 'name'),
        ['multiple' => true]
    )->label('Авторы');
?>
<?php echo $form->field($model, 'date')->widget(
    DatePicker::class,
    [
        'name' => 'anniversary',
        'readonly' => true,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]
); ?>
<div class="form-actions">
    <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>