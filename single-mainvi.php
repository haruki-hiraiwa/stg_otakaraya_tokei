<?php

/* Template Name: リダイレクト */

// リダイレクト先のURLを指定
$redirect_url = esc_url(home_url());;

// リダイレクト実行
header('Location: ' . $redirect_url);
exit;
