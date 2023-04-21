<?php

require_once "includes/db.php";

function isLogin()
{
    if (isset($_SESSION['login']) || isset($_SESSION['candidate'])) {
        return true;
    }
    return false;
}

function isAdmin()
{
    if (isset($_SESSION['login'])) {
        $user = $_SESSION['login'];

        if ($user['user_type'] == 'admin') {
            return true;
        }
    }
    return false;
}

function isKierownikHR()
{
    if (isset($_SESSION['login'])) {
        $user = $_SESSION['login'];

        if ($user['user_type'] == 'kierownikHR') {
            return true;
        }
    }
    return false;
}

function isKierownik()
{
    if (isset($_SESSION['login'])) {
        $user = $_SESSION['login'];

        if ($user['user_type'] == 'kierownik') {
            return true;
        }
    }
    return false;
}

function isPracownikHR()
{
    if (isset($_SESSION['login'])) {
        $user = $_SESSION['login'];

        if ($user['user_type'] == 'pracownikHR') {
            return true;
        }
    }
    return false;
}

function isPracownik()
{
    if (isset($_SESSION['login'])) {
        $user = $_SESSION['login'];

        if ($user['user_type'] == 'pracownik') {
            return true;
        }
    }
    return false;
}

function isAsystent()
{
    if (isset($_SESSION['login'])) {
        $user = $_SESSION['login'];

        if ($user['user_type'] == 'asystent') {
            return true;
        }
    }
    return false;
}

function isCandidate()
{
    if (isset($_SESSION['candidate'])) {
        return true;
    }
    return false;
}
 
function dump($data)
{
    echo "<pre style='padding: 10px; background-color: #ddd;'>";
    print_r($data);
    echo "</pre>";
    exit;
}
