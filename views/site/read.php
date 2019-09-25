<?php use yii\helpers\Html; ?>
<div class="magazins-read">
    <div class="pull-right btn-group">
        <?php echo Html::a('Update', array('site/update', 'id' => $post->id), array('class' => 'btn btn-primary')); ?>
        <?php echo Html::a('Delete', array('site/delete', 'id' => $post->id), array('class' => 'btn btn-danger')); ?>
    </div>

    <h1><?php echo $post->title; ?></h1>
    <div class="col-lg-3">
        <?php if ($post->image): ?>
            <img class="image-magazin" src="images/<?= $post->image ?>" alt="<?php echo $post->title; ?>"
                 style="float:left;">
        <?php endif; ?>
    </div>
    <div class="col-lg-6">
        <p><strong>Описание:</strong> <?php echo $post->description; ?></p>
        <p><strong>Авторы:</strong> <?php echo $authors; ?></p>
        <p><strong>Дата:</strong> <?php echo $post->date; ?></p>
    </div>
</div>