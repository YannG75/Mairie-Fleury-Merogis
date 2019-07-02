<?php

	$nbUsers = $db->query("SELECT COUNT(*) FROM user")->fetchColumn();

	$nbCategories = $db->query("SELECT COUNT(*) FROM faq_category")->fetchColumn();

	$nbfaq = $db->query("SELECT COUNT(*) FROM faq")->fetchColumn();

	$nbbill = $db->query("SELECT COUNT(*) FROM bill")->fetchColumn();

	$nbArticles = $db->query("SELECT COUNT(*) FROM event")->fetchColumn();

    $nbImg = $db->query("SELECT COUNT(*) FROM image_galery")->fetchColumn();
?>
<nav class="col-3 py-2 categories-nav">
	<a class="d-block btn btn-info mb-4 mt-2" href="../index.php">Site</a>
	<ul>
		<li><a href="user-list.php">Gestion des utilisateurs (<?php echo $nbUsers; ?>)</a></li>
		<li><a href="bill-list.php">Gestion des factures (<?php echo $nbbill; ?>)</a></li>
		<li><a href="category-list.php">Gestion des catégories de la faq (<?php echo $nbCategories; ?>)</a></li>
		<li><a href="faq-list.php">Gestion de la faq (<?php echo $nbfaq; ?>)</a></li>
		<li><a href="article-list.php">Gestion des évènements (<?php echo $nbArticles; ?>)</a></li>
		<li><a href="img-list.php">Gestion des images secondaire (<?php echo $nbImg; ?>)</a></li>
	</ul>
</nav>
