        <?php


        $mode = "";
        if ($_GET["mode"]) {
                $mode = $_GET["mode"];
        }
        if (!$mode == "test") {
                //echo get_field('cta02', 19025);
                include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/cta/cta02_common.php");
        } else {
                include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/cta/cta02_common.php");
        }
        ?>