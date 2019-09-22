<?php use yii\helpers\Html; ?>
<div class="pull-right btn-group">
    <?php echo Html::a('Update', array('site/update', 'id' => $post[0]->mag->id), array('class' => 'btn btn-primary')); ?>
    <?php echo Html::a('Delete', array('site/delete', 'id' => $post[0]->mag->id), array('class' => 'btn btn-danger')); ?>
</div>

<h1><?php echo $post[0]->mag->title; ?></h1>
<p>Описание: <?php echo $post[0]->mag->description; ?></p>
<p>Изображение: <?php echo $post[0]->mag->image; ?></p>
<p>Авторы: <?php
    $authors = '';
    foreach ($post as $authors) {
        $answer .= " " . $authors->aut->name . " " . $authors->aut->second_name . ",";
    }
    $answer = substr($answer, 0, -1);
    echo "$answer.";
    ?></p>
<p>Дата: <?php echo $post[0]->mag->date; ?></p>
