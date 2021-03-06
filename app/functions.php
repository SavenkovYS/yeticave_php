<?php
function include_template($template, $data)
{
    if (is_readable($template)) {
        ob_start();
        extract($data);
        require_once($template);
    } else {
        return '';
    }

    $html = ob_get_clean();
    return $html;
}

function search_user_by_email($email, $users) : array
{
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return $user;
        }
    }
    return [];
}

function is_email_used($email, $users) : bool
{
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return true;
        }
    }
    return false;
}


