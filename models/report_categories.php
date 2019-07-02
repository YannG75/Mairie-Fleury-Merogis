<?php
function getcategories() {
    $db = dbConnect();
    $queryCategories = $db->query('SELECT * FROM report_category');
    return $categoriesToSelect = $queryCategories->fetchAll();
}
getcategories();