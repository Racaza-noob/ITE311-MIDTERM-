<?= $this->extend('templates/dashboard_layout') ?>

<?= $this->section('content') ?>
    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Teacher Dashboard</h3>
                    </div>
                    <div class="card-body text-center">
                        <h1>WELCOME JIM JAMERO</h1>
                        <p class="lead">You are logged in as a Teacher</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
