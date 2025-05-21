<?php
function createSlug($title) {
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return $slug;
}

function highlightCode($code) {
    return '<pre><code class="language-php">'.htmlspecialchars($code).'</code></pre>';
}
?>