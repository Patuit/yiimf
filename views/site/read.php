<?php use yii\helpers\Html; ?>
<div class="magazins-read">
    <div class="pull-right btn-group">
        <?php echo Html::a('Update', array('site/update', 'id' => $post->id), array('class' => 'btn btn-primary')); ?>
        <?php echo Html::a('Delete', array('site/delete', 'id' => $post->id), array('class' => 'btn btn-danger')); ?>
    </div>

    <h1><?php echo $post->title; ?></h1>
    <?php if ($post->image): ?>
        <img class="image-magazin" src="images/<?= $post->image ?>" alt="<?php echo $post->title; ?>">
    <?php endif; ?>
    <p>Описание: <?php echo $post->description; ?></p>
    <p>Авторы: <?php echo $authors; ?></p>
    <p>Дата: <?php echo $post->date; ?></p>
</div>