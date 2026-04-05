<?php
namespace App\Helpers;
class CodeHighlighter {
    public static function highlight(string $line): string {
        $html = htmlspecialchars($line, ENT_QUOTES, 'UTF-8');
        foreach (['const','let','var','interface','class','function','return','export','default','import','from','type','extends','implements','new','async','await','true','false'] as $kw) {
            $html = preg_replace('/\b('.preg_quote($kw,'/').')\b/', '<span class="code-keyword">$1</span>', $html);
        }
        $html = preg_replace('/(&quot;[^&]*&quot;|&#039;[^&]*&#039;)/', '<span class="code-string">$1</span>', $html);
        $html = preg_replace('/(\/\/.*)$/', '<span class="code-comment">$1</span>', $html);
        $html = preg_replace('/\b(\d+)\b/', '<span class="code-bool">$1</span>', $html);
        return $html;
    }
}
