<?php use yii\helpers\Html; ?>
<?php use yii\widgets\ActiveForm; ?>

<?php $form = ActiveForm::begin([
    'id' => 'form-input-example',
    'options' => [
        'class' => 'form-horizontal col-lg-11',
        'enctype' => 'multipart/form-data'
    ],
]);
?>

<?php echo $form->field($model, 'name')->textInput()->label('Введите Имя'); ?>
<?php echo $form->field($model, 'second_name')->textInput()->label('Введите Фамилию'); ?>
<?php echo $form->field($model, 'third_name')->textInput()->label('Введите Отчество'); ?>
    <div class="form-actions">
        <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']); ?>
    </div>
<?php ActiveForm::end(); ?>
