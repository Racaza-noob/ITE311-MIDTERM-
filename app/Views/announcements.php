<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Announcements</h1>
        
        <?php if (empty($announcements)): ?>
            <div class="alert alert-info">No announcements available.</div>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($announcements as $announcement): ?>
                    <div class="list-group-item mb-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= esc($announcement['title']) ?></h5>
                            <small class="text-muted"><?= date('M d, Y', strtotime($announcement['created_at'])) ?></small>
                        </div>
                        <p class="mb-1"><?= nl2br(esc($announcement['content'])) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
