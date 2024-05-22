<?php
$session = \Config\Services::session();

if ($session->getFlashdata("success") !== null) {
    $alert = $session
    ?>
    <!--Injecting success alert-->
    <script>
        Swal.fire({
            position: "top-end",
            timer: 10000,
            text: "<?= $session->getFlashdata("success"); ?>",
            icon: "success"
        });
    </script>
    <?php
}


if ($session->getFlashdata("error") !== null) {
    ?>
    <!--Injecting success alert-->
    <script>
        Swal.fire({
            position: "top-end",
            timer: 10000,
            text: "<?= $session->getFlashdata("error"); ?>",
            icon: "error"
        });
    </script>
    <?php
}

if ($session->getFlashdata("info") !== null) {
    ?>
    <!--Injecting success alert-->
    <script>
        Swal.fire({
            position: "top-end",
            timer: 10000,
            text: "<?= $session->getFlashdata("info"); ?>",
            icon: "info"
        });
    </script>
    <?php
}


function flattenArray($array): array {
    $flatArray = [];
    array_walk_recursive($array, function($item) use (&$flatArray) {
        $flatArray[] = $item;
    });
    return $flatArray;
}

if (isset($_SESSION['validationErrors']) && is_array($_SESSION['validationErrors'])) {
    $flatErrors = flattenArray($_SESSION['validationErrors']);
    ?>
    <!--Injecting success alert-->
    <script>
        Swal.fire({
            position: "top-end",
            timer: 10000,
            text: "<?= implode('\n', $flatErrors) ?>",
            icon: "error",
            customClass: {
                popup: 'text-left'
            },
            showConfirmButton: false,
            width: '300px'
        });
    </script>
    <?php
}


?>
