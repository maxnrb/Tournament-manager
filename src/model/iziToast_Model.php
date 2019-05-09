<?php
define('ASSETS_BASE_URL', dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));
?>

    <!DOCTYPE html>

    <link rel="stylesheet" href="<?php echo ASSETS_BASE_URL .'/assets/modules/fontawesome/css/all.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_BASE_URL .'/assets/modules/izitoast/css/iziToast.min.css'; ?>">
    <script src="<?php echo ASSETS_BASE_URL.'/assets/modules/izitoast/js/iziToast.min.js'; ?>"></script>

<?php

class iziToast_Model {
    public static function printNotification($type, $title) {
        ?>
        <body>
            <script>
                iziToast.<?php echo $type; ?>({
                    title: '<?php echo $title; ?>',
                    position: 'topRight'
                });
            </script>
        </body>
        <?php
    }
}