<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'manage-users':
            include './adminFunction/manage_users.php';
            break;
        case 'manage-services':
            include './adminFunction/manage_services.php';
            break;
        case 'manage-bookings':
            include './adminFunction/manage_bookings.php';
            break;
        case 'payments':
            include './adminFunction/payments.php';
            break;
        case 'manage-staff':
            include './adminFunction/manage_staff.php';
            break;
        case 'manage-reviews':
            include './adminFunction/manage_reviews.php';
            break;
        case 'promotions':
            include './adminFunction/promotions.php';
            break;
        case 'contact-queries':
            include './adminFunction/contact_queries.php';
            break;
        case 'settings':
            include './adminFunction/settings.php';
            break;
        case 'reports':
            include './adminFunction/reports.php';
            break;
        case 'notifications':
            include './adminFunction/notifications.php';
            break;
        default:
            echo 'Page not found.';
            break;
    }
} else {
    echo 'Welcome to the Admin Dashboard!';
}
?>