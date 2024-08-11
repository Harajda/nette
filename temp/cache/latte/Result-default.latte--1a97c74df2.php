<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /var/www/html/app/UI/Result/default.latte */
final class Template_1a97c74df2 extends Latte\Runtime\Template
{
	public const Source = '/var/www/html/app/UI/Result/default.latte';

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

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['row' => '30'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
<h1>Results</h1>

<!-- Formulář pro filtrování -->
<form action="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('filter')) /* line 6 */;
		echo '" method="get">
    <input type="text" name="name" placeholder="Filter by name" value="';
		echo LR\Filters::escapeHtmlAttr($filter['name'] ?? '') /* line 7 */;
		echo '" />
    <button type="submit">Filter</button>
</form>

<!-- Možnosti řazení -->
<form action="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('sort')) /* line 12 */;
		echo '" method="get">
    <select name="sort" onchange="this.form.submit()">
        <option value="name" ';
		if ($sort == 'name') /* line 14 */ {
			echo 'selected';
		}
		echo '>Sort by Name</option>
        <option value="comments" ';
		if ($sort == 'comments') /* line 15 */ {
			echo 'selected';
		}
		echo '>Sort by Comments</option>
        <option value="interests" ';
		if ($sort == 'interests') /* line 16 */ {
			echo 'selected';
		}
		echo '>Sort by Interests</option>
    </select>
</form>

<!-- Tabulka s výsledky -->
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Comment</th>
            <th>Interests</th>
        </tr>
    </thead>
    <tbody>
';
		foreach ($data as $row) /* line 30 */ {
			echo '        <tr style="padding:5px; margin:5px;background-color:#f2f2f2">
            <td>';
			echo LR\Filters::escapeHtmlText($row->name) /* line 32 */;
			echo '</td>
            <td>';
			echo LR\Filters::escapeHtmlText($row->comments) /* line 33 */;
			echo '</td>
            <td>';
			echo LR\Filters::escapeHtmlText($row->interests) /* line 34 */;
			echo '</td>
        </tr>
';

		}

		echo '    </tbody>
</table>

<!-- Stránkování -->
<div>
';
		if ($page > 1) /* line 42 */ {
			echo '        <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Result:default', [$prevPage])) /* line 43 */;
			echo '">Previous</a>
';
		}
		if ($page < $totalPages) /* line 45 */ {
			echo '        <a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('Result:default', [$nextPage])) /* line 46 */;
			echo '">Next</a>
';
		}
		echo '</div>



';
	}
}
