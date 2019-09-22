<?php use yii\helpers\Html; ?>
<div class="pull-right btn-group">
    <?php echo Html::a('Update', array('authors/update', 'id' => $post->id), array('class' => 'btn btn-primary')); ?>
    <?php echo Html::a('Delete', array('authors/delete', 'id' => $post->id), array('class' => 'btn btn-danger')); ?>
</div>

<h1><?php echo $post->name; ?></h1>
<p>Фамилия: <?php echo $post->second_name; ?></p>
<p>Отчество: <?php echo $post->third_name; ?></p>
