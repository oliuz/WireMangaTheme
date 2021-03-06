<?php namespace ProcessWire;

$bodyClass .= " manga-archive";

$field = $page->parent->name;
if($field === "scan-status") {
	$results = $pages->find("template=wm_manga_single, limit=24, wm_scan_status={$page->name}, sort=-published, sort=name");
} elseif($field === "manga-status") {
	$results = $pages->find("template=wm_manga_single, limit=24, wm_manga_status={$page->name}, sort=-published, sort=name");
} else {
	$results = $pages->find("template=wm_manga_single, limit=24, wm_{$field}={$page->name}, sort=-published, sort=name");
}

if($input->pageNum){
	$limit = 24;
	if ($input->pageNum > 1) {
		$relPrev = "<link rel='prev' href='{$page->httpUrl}{$config->pageNumUrlPrefix}".($input->pageNum-1)."' />\n";
	}
	if ($input->pageNum * $limit < $results->getTotal()) {
		$relNext = "<link rel='next' href='{$page->httpUrl}{$config->pageNumUrlPrefix}".($input->pageNum+1)."' />";
	}
}

$vars = array(
	"page" => $page,
	"results" => $results,
	"pagination" => $results->renderPager($paginationOptions),
);

$content = $files->render(__DIR__ . "/views/Terms.php", $vars);

include("_main.php");