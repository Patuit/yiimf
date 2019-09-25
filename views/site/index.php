<?php
$this->title = 'Журналы';
use yii\helpers\Html;
use yii\widgets\LinkPager;

echo Html::a('Добавить журнал', array('site/create'), array('class' => 'btn btn-primary pull-right')); ?>
    <div class="clearfix"></div>
    <hr/>
    <table class="table table-striped table-hover">
        <tr>
            <td>ID</td>
            <td>Название</td>
            <td>Описание</td>
            <td>Картинка</td>
            <td>Дата</td>
            <td>Авторы</td>
            <td>Действия</td>
        </tr>
        <?php foreach ($data as $key => $magazins): ?>
            <tr>
                <td>
                    <?php echo Html::a($magazins->id, array('site/read', 'id' => $magazins->id)); ?>
                </td>
                <td><?php echo Html::a($magazins->title, array('site/read', 'id' => $magazins->id)); ?></td>
                <td><?php echo $magazins->description; ?></td>
                <td><?php echo $magazins->image; ?></td>
                <td><?php echo $magazins->date; ?></td>
                <td><?php
                    echo $authors[$key];
                    ?></td>
                <td>
                    <?php echo Html::a('Изменить', array('site/update', 'id' => $magazins->id), array('class' => 'btn btn-primary')); ?>
                    <?php echo Html::a('Удалить', array('site/delete', 'id' => $magazins->id), array('class' => 'btn btn-danger')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <hr>
<?php if (Yii::$app->session->hasFlash('PostDeletedError')): ?>
    <div class="alert alert-error">
        При удалении журнала из базы данных произошла ошибка!
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('PostDeleted')): ?>
    <div class="alert alert-success">
        Журнал был успешно удален из базы данных!
    </div>
<?php endif; ?>


<?= LinkPager::widget([
    'pagination' => $pages,
]); ?>