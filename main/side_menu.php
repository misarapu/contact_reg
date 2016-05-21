<?php

require '../models/model_side_menu.php';


echo '<ul class="nav nav-pills nav-stacked" id="ul-menu-list">';
foreach (model_load_menu_list() as $data) {
    echo '<li class="list-group-item" id="id-' . $data['id'] . '" name="load_profile" onclick="loadProfile(' . $data['id'] . ')">'
                  . $data['fn'] . ' ' . $data['ln'] .
          '</li>';
}
echo '</ul>';
