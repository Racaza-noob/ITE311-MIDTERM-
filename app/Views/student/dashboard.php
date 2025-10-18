<?= $this->extend('templates/dashboard_layout') ?>

<?= $this->section('content') ?>
    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="text-center mt-5">
        <h1>Welcome, <?= esc($user['name'] ?? 'Jerald Student') ?></h1>
    </div>
<?= $this->endSection() ?>
