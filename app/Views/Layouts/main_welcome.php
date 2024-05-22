<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="opacity-0" lang="en"><!-- BEGIN: Head -->

<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="ceKdwoQjZ4VuoGqoSQaSREwB7MD9sjwFnfhlp7MH">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Abdulmujib Nizary(Kibuti Software)">
    <title>Better Carrier Portal</title>
    <!-- BEGIN: CSS Assets-->
    <!-- END: CSS Assets-->
    <link rel="stylesheet" href="dist/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css"
          integrity="sha512-OQDNdI5rpnZ0BRhhJc+btbbtnxaj+LdQFeh0V9/igiEPDiWE2fG+ZsXl0JEH+bjXKPJ3zcXqNyP4/F/NegVdZg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css " rel="stylesheet">
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js "></script>
</head>
<!-- END: Head -->
<body>
<?= $this->renderSection("content") ?>
<script>
    document.getElementById('form').addEventListener('submit', function () {
        const submitButton = document.getElementById('submit');
        submitButton.innerHTML = 'Submitting...';
        submitButton.disabled = true;
    });
</script>
<!-- BEGIN: Vendor JS Assets-->
<script src="dist/js/vendors/dom.js"></script>
<script src="dist/js/vendors/tailwind-merge.js"></script>
<script src="dist/js/vendors/lucide.js"></script>
<script src="dist/js/vendors/modal.js"></script>
<script src="dist/js/components/base/theme-color.js"></script>
<script src="dist/js/components/base/lucide.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css " rel="stylesheet">
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js "></script>
<!-- END: Vendor JS Assets-->
<!-- BEGIN: Pages, layouts, components JS Assets-->
<!-- END: Pages, layouts, components JS Assets-->
</body>
</html>
