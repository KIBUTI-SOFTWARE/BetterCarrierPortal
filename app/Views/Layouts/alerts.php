<?php
$session = \Config\Services::session();

if ($session->getFlashdata("success") !== null) {
    $alert = $session->getFlashdata("success");
    ?>
    <!--Injecting success alert-->
    <script>
        Swal.fire({
            position: "top-end",
            timer: 10000,
            text: "<?= $alert['message']; ?>",
            icon: "success"
        });
    </script>
    <?php
}


if ($session->getFlashdata("error") !== null) {
    $alert = $session->getFlashdata("error");
    ?>
    <!--Injecting success alert-->
    <script>
        Swal.fire({
            position: "top-end",
            timer: 10000,
            text: "<?= $alert['message']; ?>",
            icon: "error"
        });
    </script>
    <?php
}

if ($session->getFlashdata("info") !== null) {
    $alert = $session->getFlashdata("info");
    ?>
    <!--Injecting success alert-->
    <script>
        Swal.fire({
            position: "top-end",
            timer: 10000,
            text: "<?= $alert['message']; ?>",
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
