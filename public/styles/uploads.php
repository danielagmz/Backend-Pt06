<style>
    <?php if (isset($_SESSION['banner']) && !empty($_SESSION['banner'])): ?>
        .banner {
            
            background-image: url('<?php echo $_SESSION['banner']; ?>');
        }
    <?php endif; ?>
    <?php if (isset($_SESSION['avatar']) && !empty($_SESSION['avatar'])): ?>
        .banner::after {
            background-image: url('<?php echo $_SESSION['avatar']; ?>');
        }
    <?php endif; ?>
</style>