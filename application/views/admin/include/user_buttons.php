<!--
    <a href="#" class="btn btn-info btn-xs">Send Mail</a>
    <a href="#" class="btn btn-info btn-xs">Edit</a>
-->
<?php
    if($user['is_deleted'] == 1){
?>
<!--
    <button data-toggle="tooltip" title="Restore Account" class="btn btn-success btn-xs"
onclick="open_delete_modal(<?= $user['id'] ?>)"><i class="fa fa-undo"></i></button>
-->
<?php
    } else {
?>
<button data-toggle="tooltip" title="Delete User" class="btn btn-danger btn-xs"
    onclick="open_delete_modal(<?= $user['id'] ?>)">
    <i class="fa fa-trash"></i>
</button>
<?php
    }
?>
<?php
    if($user['is_blocked'] == 1){
?>
<button data-toggle="tooltip" title="Unblock User" class="btn btn-success btn-xs"
    onclick="open_delete_modal(<?= $user['id'] ?>)">
    <i class="fa fa-ban"></i>
</button>
<?php
    } else {
?>
<!-- <button data-toggle="tooltip" title="Block User" class="btn btn-danger btn-xs"
    onclick="open_delete_modal(<?= $user['id'] ?>)">
    <i class="fa fa-ban"></i>
</button> -->
<?php
    }
?>