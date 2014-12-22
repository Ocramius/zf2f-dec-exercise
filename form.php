<?php


// $data => $form => $inputFilter => $hydrator => $model

// $form = $inputFilter + $hydrator

$blog = new BlogPost();

$form->bind($blog);
$form->setData($_POST);

if ($form->isValid()) {
    $this->service->save($form->getObject());
}

