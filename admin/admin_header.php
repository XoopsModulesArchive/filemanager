<?php

include '../../../mainfile.php';
include XOOPS_ROOT_PATH . '/include/cp_functions.php';

if (file_exists('../language/' . $xoopsConfig['language'] . '/admin.php')) {
    include '../language/' . $xoopsConfig['language'] . '/admin.php';
} else {
    include '../language/english/admin.php';
}
