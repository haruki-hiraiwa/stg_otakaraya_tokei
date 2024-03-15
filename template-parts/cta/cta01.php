        <?php


        $mode = "";
        if ($_GET["mode"]) {
                $mode = $_GET["mode"];
        }
        if (!$mode == "test") {
                //echo get_field('cta01', 19025);
                include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/cta/cta01_common.php");
        } else {
                include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/cta/cta01_common.php");
        }
        ?>