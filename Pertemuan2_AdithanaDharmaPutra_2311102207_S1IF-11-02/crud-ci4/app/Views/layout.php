<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .card { box-shadow: 0 4px 6px rgba(0,0,0,.05); border: none; }
        .table-responsive { overflow-x: auto; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 border-bottom">
  <div class="container">
<a class="navbar-brand" href="<?= base_url('/') ?>">
  <img src="<?= base_url('logo.png') ?>" alt="Logo" height="40"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('barang') ?>">Management Barang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('kasir') ?>">Kasir</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container pb-5">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?= view($view) ?>
</div>

</body>
</html>
