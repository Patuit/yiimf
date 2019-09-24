<?php use yii\helpers\Html; ?>
<div class="pull-right btn-group">
    <?php echo Html::a('Update', array('authors/update', 'id' => $post->id), array('class' => 'btn btn-primary')); ?>
    <?php echo Html::a('Delete', array('authors/delete', 'id' => $post->id), array('class' => 'btn btn-danger')); ?>
</div>

<h1>Автор:</h1>
<hr>
<p>Имя: <?php echo $post->name; ?></p>
<p>Фамилия: <?php echo $post->second_name; ?></p>
<p>Отчество: <?php echo $post->third_name; ?></p>
<hr>
<table class="table table-striped table-hover">
    <tr>
        <td>ID</td>
        <td>Название</td>
        <td>Описание</td>
        <td>Картинка</td>
        <td>Дата</td>
    </tr>
    <?php foreach ($magazins as $key => $magazin): ?>
        <tr>
            <td>
                <?php echo Html::a($magazin->mag->id, array('site/read', 'id' => $magazin->mag->id)); ?>
            </td>
            <td><?php echo Html::a($magazin->mag->title, array('site/read', 'id' => $magazin->mag->id)); ?></td>
            <td><?php echo $magazin->mag->description; ?></td>
            <td><?php echo $magazin->mag->image; ?></td>
            <td><?php echo $magazin->mag->date; ?></td>
        </tr>
    <?php endforeach; ?>
</table>