<?php
$pmUser = current_user();
if ($pmUser !== null && $pmUser['type'] === 'buyer'):
    $pmInitial = mb_strtoupper(mb_substr((string) $pmUser['username'], 0, 1, 'UTF-8'), 'UTF-8');
?>
<div class="profile" id="profileMenu">
    <button type="button" class="profile-btn" id="profileBtn"
            aria-haspopup="true" aria-expanded="false" aria-controls="profileDropdown"
            title="My account">
        <?= e($pmInitial) ?>
    </button>

    <div class="profile-dropdown" id="profileDropdown" role="menu" hidden>
        <div class="profile-info">
            <div class="profile-avatar"><?= e($pmInitial) ?></div>
            <div class="profile-text">
                <strong class="profile-name"><?= e($pmUser['username']) ?></strong>
                <span class="profile-email"><?= e($pmUser['email']) ?></span>
                <span class="profile-role">Buyer account</span>
            </div>
        </div>
        <a href="logout.php" class="profile-logout" role="menuitem">Log Out</a>
    </div>
</div>
<?php endif; ?>