<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /var/www/html/app/UI/@layout.latte */
final class Template_20181cf646 extends Latte\Runtime\Template
{
	public const Source = '/var/www/html/app/UI/@layout.latte';

	public const Blocks = [
		['title' => 'blockTitle'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo '<!DOCTYPE html>
<html>
<head>
	<title>';
		$this->renderBlock('title', get_defined_vars()) /* line 4 */;
		echo '</title>
</head>
<body>
	<header>';
		foreach ($flashes as $flash) /* line 7 */ {
			echo '<div';
			echo ($ʟ_tmp = array_filter(['flash', $flash->type])) ? ' class="' . LR\Filters::escapeHtmlAttr(implode(" ", array_unique($ʟ_tmp))) . '"' : "" /* line 7 */;
			echo '>';
			echo LR\Filters::escapeHtmlText($flash->message) /* line 7 */;
			echo '</div>';
		}

		echo '</header>
	<main>';
		$this->renderBlock('content', [], 'html') /* line 8 */;
		echo '</main>
	<footer></footer>
</body>
</html>';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['flash' => '7'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block title} on line 4 */
	public function blockTitle(array $ʟ_args): void
	{
		echo 'My App';
	}
}
