<?php

require '../models/model_profile.php';

// moodustatakse menüü list

echo '<ul class="nav nav-pills nav-stacked" id="ul-menu-list">';
foreach (model_load_profile() as $data) {
    echo '<li class="list-group-item" id="id-' . $data['c_id'] . '" name="load_profile" onclick="loadProfile(' . $data['c_id'] . ')">
              <a>'
                  . $data['fn'] . ' ' . $data['ln'] .
             '</a>
          </li>';
}
echo '</ul>';
