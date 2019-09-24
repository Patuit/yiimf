<?php use yii\helpers\Html; ?>
<?php use yii\widgets\ActiveForm; ?>

<?php $form = ActiveForm::begin([
    'id' => 'form-create-update-author',
    'options' => [
        'class' => 'form-horizontal col-lg-11',
        'enctype' => 'multipart/form-data',
        'data-pjax' => true,
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
    <hr>
<!---->
<?php //if (Yii::$app->session->hasFlash('AuthorsCreateError')): ?>
<!--    <div class="alert alert-error">-->
<!--        При внесении данных автора в базу произошла ошибка!-->
<!--    </div>-->
<?php //endif; ?>
<!---->
<?php //if (Yii::$app->session->hasFlash('AuthorsCreateSuccess')): ?>
<!--    <div class="alert alert-success">-->
<!--        Данные автора были успешно внесены в базу!-->
<!--    </div>-->
<?php //endif; ?>
<!---->
<?php //if (Yii::$app->session->hasFlash('AuthorsUpdateError')): ?>
<!--    <div class="alert alert-error">-->
<!--        При обновлении данных автора в базе произошла ошибка!-->
<!--    </div>-->
<?php //endif; ?>
<!---->
<?php //if (Yii::$app->session->hasFlash('AuthorsUpdateSuccess')): ?>
<!--    <div class="alert alert-success">-->
<!--        Данные автора были успешно обновлены в базе!-->
<!--    </div>-->
<?php //endif; ?>