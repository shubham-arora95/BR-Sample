<?php foreach ($menus as $menu): ?>
<!--<ul><?= h($menu->name) ?></ul>-->
<li><?= $this->Html->link(__("$menu->name"), ['controller' => "$menu->controller", 'action' => "$menu->action"]) ?></li>
<?php //echo "localhost:8765/".$this->Url->build([
    //"controller" => "$menu->controller",
    //"action" => "$menu->action"
//]); ?>
<?php endforeach; ?>