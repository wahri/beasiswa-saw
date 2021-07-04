<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin</title>
    <link href="<?= base_url('assets/') ?>css-admin/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script>
        i = 1;
        j = 1;

        function tambah_baris() {
            html = '<div class="form-group"><div class="row"><div class="col-2"><label for="pilihan">Urutan</label><div class="input-group mb-2"><input type="text" class="form-control" id="urutan[]" name="urutan[]" value="' + i + '" readonly></div></div><div class="col-10"><label for="pilihan">Nama Pilihan</label><div class="input-group mb-2"><input type="text" class="form-control" id="nama_pilihan[]" name="nama_pilihan[]" placeholder="Nama pilihan"></div></div></div></div>';
            $('#tambahbaris').append(html);
            i++;
        }

        function tambah_baris_input() {
            html = '<div class="form-group"><div class="row"><div class="col-1"><label for="pilihan">Urutan</label><div class="input-group mb-2"><input type="text" class="form-control" id="urutan[]" name="urutan[]" value="' + j + '" readonly></div></div><div class="col-3"><label for="pilihan">Rentang terkecil</label><div class="input-group mb-2"><input type="text" class="form-control" id="min[]" name="min[]" placeholder="Angka terkecil"></div></div><div class="col-3"><label for="pilihan">Rentang terbesar</label><div class="input-group mb-2"><input type="text" class="form-control" id="max[]" name="max[]" placeholder="Angka terbesar"></div></div></div></div>';
            $('#tambahbarisinput').append(html);
            j++;
        }
    </script>
</head>

<body class="sb-nav-fixed">