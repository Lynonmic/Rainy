<?php
function generateNav($activePage)
{
    $navItems = [
        'home' => ['label' => 'HOME', 'icon' => '🏠', 'url' => '../index.php'],
        'about' => ['label' => 'ABOUT', 'icon' => 'ℹ️', 'url' => '../pages/about.php'],
        'services' => ['label' => 'SERVICES', 'icon' => '📚', 'url' => '../pages/services.php'],
        'news' => ['label' => 'NEWS', 'icon' => '📰', 'url' => '../pages/news.php'],
        'contact' => ['label' => 'CONTACT', 'icon' => '📞', 'url' => '../pages/contact.php']
    ];

    echo '<ul>';
    foreach ($navItems as $key => $item) {
        $activeClass = ($key === $activePage) ? 'class="active"' : '';
        echo '<li class="nav-item">';
        echo '<a href="' . $item['url'] . '" ' . $activeClass . '><span class="icon">' . $item['icon'] . '</span>' . $item['label'] . '</a>';
        echo '</li>';
    }
    echo '<li class="nav-item">';
    if (isset($_SESSION['username'])) {
        echo '<div class="user-info">';
        echo '<a href="../pages/user.php"><span class="username">' . htmlspecialchars($_SESSION['username']) . '</span></a>';
        echo '<button class="btn-signin" onclick="window.location.href=\'../php/logout.php\'">Logout</button>';
        echo '</div>';
    } else {
        echo '<a href="../pages/signin.php" class="btn-signin"><span class="icon">🔑</span>Sign-in</a>';
    }
    echo '</li>';
    echo '<li class="nav-item">';
    echo '</li>';
    echo '</ul>';
}
?>