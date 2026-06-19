<?php

/**
 * A simple link card renderer for displaying a preview card with a title,
 * description, and a clickable link. The output is safely escaped HTML.
 */
class LinkCard {
    private string $url;
    private string $title;
    private string $description;
    private string $domain;
    private string $favicon;

    public function __construct(
        string $url = 'https://hthzh.com.cn',
        string $title = '华体会 — 探索无限可能',
        string $description = '华体会致力于为用户提供丰富多元的在线体验，涵盖体育、娱乐等多重领域。',
        string $domain = 'hthzh.com.cn',
        string $favicon = 'data:image/svg+xml,' . urlencode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><circle cx="16" cy="16" r="14" fill="#4A90D9"/><text x="16" y="22" font-size="18" text-anchor="middle" fill="white" font-family="Arial">华</text></svg>')
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->domain = $domain;
        $this->favicon = $favicon;
    }

    /**
     * Render the link card as an HTML string with all dynamic content escaped.
     *
     * @return string Safe HTML.
     */
    public function render(): string {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedFavicon = htmlspecialchars($this->favicon, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" class="link-card-anchor">
        <div class="link-card-content">
            <div class="link-card-favicon-wrapper">
                <img src="{$escapedFavicon}" alt="icon" class="link-card-favicon" width="24" height="24" loading="lazy">
            </div>
            <div class="link-card-text">
                <span class="link-card-title">{$escapedTitle}</span>
                <span class="link-card-description">{$escapedDesc}</span>
                <span class="link-card-domain">{$escapedDomain}</span>
            </div>
        </div>
    </a>
</div>
HTML;
    }

    /**
     * Static factory method: create a card with custom data.
     *
     * @param string $url
     * @param string $title
     * @param string $description
     * @return self
     */
    public static function create(string $url, string $title, string $description): self {
        $parsed = parse_url($url);
        $domain = $parsed['host'] ?? 'unknown';
        return new self($url, $title, $description, $domain);
    }

    /**
     * Output the rendered card directly.
     */
    public function display(): void {
        echo $this->render();
    }
}

// --- Example usage (uncomment to test) ---
/*
$card = new LinkCard();
$card->display();

// Or using the factory:
$custom = LinkCard::create(
    'https://hthzh.com.cn',
    '华体会 — 多元体育娱乐平台',
    '加入华体会，感受体育与娱乐的完美融合，尽享精彩赛事与丰富活动。'
);
$custom->display();
*/