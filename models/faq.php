<?php
function getFaq()
{
    $db = dbConnect();
    $query = $db->prepare('SELECT *
		FROM faq');
    $query->execute();
    return $faq_cat1 = $query->fetchAll(PDO::FETCH_ASSOC);

}

function getCategories(){
    $db = dbConnect();
    $query = $db->prepare('SELECT *
		FROM faq_category');
    $query->execute();
    return $faq_cat = $query->fetchAll(PDO::FETCH_ASSOC);
}

function getCountCategories(){
    $db = dbConnect();
    $nbCategories = $db->query("SELECT COUNT(*) FROM faq_category")->fetchColumn();
    return $nbCategories;
}