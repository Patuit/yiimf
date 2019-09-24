<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?php $this->title = 'Авторы' ?>
<?php echo Html::a('Create New Post', array('authors/create'), array('class' => 'btn btn-primary pull-right')); ?>
    <div class="clearfix"></div>
    <hr />
    <table class="table table-striped table-hover">
        <tr>
            <td>ID</td>
            <td>Имя</td>
            <td>Фамилия</td>
            <td>Отчество</td>
            <td>Действия</td>
        </tr>
        <?php foreach ($data as $post): ?>
            <tr>
                <td>
                    <?php echo Html::a($post->id, array('authors/read', 'id'=>$post->id)); ?>
                </td>
                <td><?php echo Html::a($post->name, array('authors/read', 'id'=>$post->id)); ?></td>
                <td><?php echo $post->second_name; ?></td>
                <td><?php echo $post->third_name; ?></td>
                <td>
                    <?php echo Html::a('Update', array('authors/update', 'id' => $post->id), array('class' => 'btn btn-primary')); ?>
                    <?php echo Html::a('Delete', array('authors/delete', 'id' => $post->id), array('class' => 'btn btn-danger')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <hr>
<?php if(Yii::$app->session->hasFlash('PostDeletedError')): ?>
    <div class="alert alert-error">
        При удалении автора из базы данных произошла ошибка!
    </div>
<?php endif; ?>

<?php if(Yii::$app->session->hasFlash('PostDeleted')): ?>
    <div class="alert alert-success">
        Автор был успешно удален из базы данных!
    </div>
<?php endif; ?>

<?= LinkPager::widget([
    'pagination' => $pages,
]); ?>
