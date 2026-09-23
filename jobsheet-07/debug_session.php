<?php
$page_title = "Debug Session";
include __DIR__ . '/includes/header.php';
?>
<section>
    <h2>Debug Data Session</h2>
    <p>Di bawah ini adalah isi mentah dari <code>$_SESSION</code> yang tersimpan di server saat ini:</p>

    <div style="background: #2b1b3d; color: #00ff00; padding: 15px; border-radius: 8px; overflow-x: auto;">
        <pre><?php print_r($_SESSION); ?></pre>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>