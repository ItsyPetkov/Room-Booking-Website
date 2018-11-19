<?php
/**
 * Created by IntelliJ IDEA.
 * User: dinko
 * Date: 18/11/2018
 * Time: 19:26
 */
    session_start();

    if(session_destroy()) {
        header("Location:index.html");
    }
?>