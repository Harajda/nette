<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /var/www/html/app/UI/Result/show.latte */
final class Template_213ee2108f extends Latte\Runtime\Template
{
	public const Source = '/var/www/html/app/UI/Result/show.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		echo "\n";
		$this->renderBlock('content', get_defined_vars()) /* line 2 */;
	}


	/** {block content} on line 2 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
<div style="padding:5px; margin:5px;background-color:#f2f2f2">
    <b>';
		echo LR\Filters::escapeHtmlText($survey->name) /* line 5 */;
		echo '</b>
    <p>';
		echo LR\Filters::escapeHtmlText($survey->comments) /* line 6 */;
		echo '</p>
    <p>';
		echo LR\Filters::escapeHtmlText($survey->interests) /* line 7 */;
		echo '</p>
</div>

';
	}
}
