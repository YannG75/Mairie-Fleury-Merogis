<?php
require ('./models/faq.php');
$faq = getFaq();
$faqCat = getCategories();
$count = getCountCategories();
require ('./views/faq.php');
